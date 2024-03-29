<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\Files\FileSubmitRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\Files\File;
use App\Models\Files\FileCategory;
use App\Models\Files\FileVersion;
use App\Services\Files\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $categories = FileCategoryController::getCategories();

        $files = FileFilterController::filter($request, $categories);

        if ($request->ajax()) {
            return response()->json(view('components.files._files', [
                'files' => $files
            ])->render());
        }

        return view('files.index', [
            'files' => $files,
            'categories' => $categories
        ]);
    }

    public function submit()
    {
        return view('files.submit', [
            'categories' => FileCategoryController::getCategories()
        ]);
    }

    public function store(FileSubmitRequest $request, FileService $file_service)
    {
        $user = auth()->user();
        $saved_file = $file_service->save($request->file('file'));

        if (!$saved_file['success']) {
            return back()->withErrors($saved_file['errors'])->with($saved_file['flash']);
        }

        $file = new File();
        $file->category_id = FileCategory::where('name', $request->category)->first()->id;
        $file->user_id = $user->id;
        $file->title = trim($request->title);
        $file->name = trim($request->name);
        $file->description = $request->description;

        if ($request->has('price')) {
            $file->price = $request->price;
        }

        if ($request->hasFile('cover')) {
            FileCoverController::store($file, $request->file('cover'));
        }

        if ($file->description and $file->cover_path and $user->is_admin) {
            $file->is_visible = true;
            $file->is_approved = true;
        }

        $file->save();

        FileVersion::create(array_merge([
            'file_id' => $file->id
        ], $saved_file));

        return redirect()->route('file.show', ['id' => $file->id]);
    }

    public function show(Request $request, $id)
    {
        $file = Cache::remember('file.' . $id, now()->addHour(), function() use ($id) {
            $f = File::where('id', $id)->with(['category', 'user'])->first();

            if ($f->price) {
                $f->loadCount('purchases');
            }

            return $f;
        });

        if (!$file) {
            return redirect()->route('home');
        }

        // $user = $request->user();

        // if (!$user and ($file->user_id != $user and ($file->is_visible or $file->is_approved))) {
        //     return redirect()->route('home');
        // }

        $view_cache_key = 'file.' . $id . '.view.' . ($_SERVER['CF_CONNECTING_IP'] ?? $request->ip());

        if (!Cache::has($view_cache_key)) {
            Cache::put($view_cache_key, $id, now()->addHour());
            $file->increment('views_count');
        }

        // $this->updateVirusTotalStatus($file);

        return view('files.show', [
            'file' => $file
        ]);
    }

    public function download(Request $request, $id)
    {
        $file = File::where('id', $id)->first();

        if (!$file) {
            return redirect()->route('home')->withErrors(['file_not_found' => 'Запрашиваемый файл не найден']);
        }

        // TODO: Настройка: возможность отключить возможность скачивания неавторизованным пользователям

        if (auth()->id() != $file->user_id and (!$file->is_visible or !$file->is_approved)) {
            return redirect()->route('file.show', ['id' => $file->id])->withErrors(['cant_download' => 'Запрашиваемый файл ещё не был одобрен администрацией']);
        }
        
        if (auth()->id() != $file->user_id and !is_null($file->price) and !$request->user()->hasPurchasedFile($file)) {
            return back()->withErrors(['purchase_required' => 'Вы должны сначала приобрести указанный файл']);
        }

        if (!Storage::exists($file->path)) {
            return back()->withErrors(['file_missing' => 'Файл отсутствует на сервере']);
        }

        $file->increment('downloads_count');

        return response()->download(storage_path('app/' . $file->path), ($file->version ? $file->name . ' - ' . $file->version : $file->name) . '.' . $file->extension, [
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }

    public function edit($id)
    {
        $file = File::where('id', $id)->where('user_id', auth()->user()->id)->withCount('media')->first();

        if (!$file) {
            return back();
        }

        return view('files.edit', [
            'file' => $file,
            'categories' => FileCategoryController::getCategories()
        ]);
    }

    public function update(FileUpdateRequest $request, $id)
    {
        $file = File::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$file) {
            return back()->withErrors(['not_found' => 'Вы не можете редактировать указанный файл'])->withInput($request->validated());
        }

        $file->title = trim($request->title);
        $file->name = trim($request->name);
        // $file->description = FileDescriptionController::normalize($request->description);
        $file->price = $request->price ?? null;
        $file->version = trim($request->version) ?? null;

        if ($request->has('donation_url')) {
            $file->donation_url = trim($request->donation_url);
        }

        if ($request->has('keywords')) {
            $file->keywords = trim($request->keywords);
        }

        if ($request->hasFile('cover')) {
            $file->cover_path = FileCoverController::store($file, $request->file('cover'));
        }

        $file->is_visible = (!is_null($file->description) and !empty(strip_tags($file->description)));

        $file->save();

        Cache::forget('file.' . $file->id);

        return redirect()->route('file.show', ['id' => $file->id]);
    }

    public function destroy($id)
    {
        $file = File::where('id', $id)->first();

        if (auth()->user()->id != $file->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете удалить указанный файл'
            ]);
        }

        Storage::delete($file->path);

        $file->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('home')
        ]);
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['Б', 'КБ', 'МБ', 'ГБ', 'ТБ', 'ПБ'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function save($file, $old = null)
    {
        if (!is_null($old)) {
            Storage::delete($old);
        }

        $name = Str::random(40);
        $extension = $file->getClientOriginalExtension();

        if (Storage::exists('files/' . $name . '.' . $extension)) {
            return self::save($file, $old);
        }

        return Storage::putFileAs('files', $file, $name . '.' . $extension);
    }
}
