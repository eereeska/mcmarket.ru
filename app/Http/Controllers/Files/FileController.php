<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileSubmitRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use App\Models\FileCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

    public function store(FileSubmitRequest $request)
    {
        $user = auth()->user();

        $request_file = $request->file('file');
        $request_file_extension = $request_file->getClientOriginalExtension();

        // if ($request->type != 'paid') {
        //     $vt_analyse_response = Http::withHeaders([
        //         'x-apikey' => $this->vt_key
        //     ])->attach('file', file_get_contents($request_file), $request->name)->post('https://www.virustotal.com/api/v3/files');
    
        //     if ($vt_analyse_response->failed() or array_key_exists('error', $vt_analyse_response->json())) {
        //         return back()->withErrors(['vt_error' => 'Не удалось загрузить файл для проверки на VirusTotal'])->withInput($request->all());
        //     }
        // }

        $path = $this->save($request_file);

        if (!$path) {
            return back()->withErrors(['store_error' => 'Не удалось сохранить файл'])->withInput($request->all());
        }

        $category = FileCategory::where('name', $request->category)->first();

        $file = new File();
        $file->category_id = $category->id;
        $file->user_id = $user->id;
        $file->title = $request->title;
        $file->name = $request->name;
        $file->type = $request->type;
        $file->size = $request_file->getSize();
        $file->path = $path;
        $file->extension = $request_file_extension;

        if ($request->type == 'paid') {
            $file->price = $request->price;
        }

        $file->save();

        return redirect()->route('file.show', ['id' => $file->id]);
    }

    public function show(Request $request, $id)
    {
        $file = Cache::remember('file.' . $id, now()->addHour(), function() use ($id) {
            return File::where('id', $id)->with(['category', 'media', 'user'])->withCount(['media', 'purchases'])->first();
        });

        if (!$file) {
            return redirect()->route('home');
        }

        $user = $request->user();

        if (!$user and ($file->user_id != $user and ($file->is_visible or $file->is_approved))) {
            return redirect()->route('home');
        }

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
        $user = $request->user();
        $file = File::where('id', $id)->first();

        if (!$file) {
            return redirect()->route('home')->withErrors(['file_not_found' => 'Запрашиваемый файл не найден']);
        }

        if ($user->id != $file->user_id and (!$file->is_visible or !$file->is_approved)) {
            return redirect()->route('file.show', ['id' => $file->id])->withErrors(['cant_download' => 'Запрашиваемый файл ещё не был одобрен администрацией']);
        }
        
        if ($user->id != $file->user_id and $file->type == 'paid' and !$request->user()->hasPurchasedFile($file)) {
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

        if (auth()->user()->role->can_approve_files) {
            return redirect()->route('admin.file.edit', ['id' => $file->id]);
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
        $file->description = $this->normalizeDescription($request->description);
        $file->type = trim($request->type);
        
        if ($file->type == 'paid') {
            $file->price = $request->price ?? null;
        }

        if ($request->has('version')) {
            $file->version = trim($request->version);
        }

        if ($request->has('donation_url')) {
            $file->donation_url = trim($request->donation_url);
        }

        if ($request->has('keywords')) {
            $file->keywords = trim($request->keywords);
        }

        if ($request->has('cover')) {
            $cover = $request->file('cover');

            if (!is_null($file->cover_path)) {
                Storage::delete($file->cover_path);
            }

            // TODO: переделать сохранение обложки

            $path = Str::random(40) . '.' . $cover->getClientOriginalExtension();

            Image::make($cover)->fit(300, 300)->save(storage_path('app/public/covers/' . $path));

            $file->cover_path = $path;
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

        Storage::delete('app/' . $file->path . '.' . $file->extension);

        $file->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('home')
        ]);
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function normalizeDescription($description)
    {
        $description = trim($description);

        $allowed_tags = [
            'p', 'b', 'u', 's', 'ul', 'li', 'ol', 'br'
        ];

        $description = strip_tags($description, $allowed_tags);

        $description = preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $description);
        $description = preg_replace('/\<p\>\<\/p\>/i', '', $description);
        $description = preg_replace('/\<p\>\<br\>\<\/p\>/i', '', $description);
        $description = preg_replace('/\<p\>\<br \/\>\<\/p\>/i', '', $description);

        if (empty($description)) {
            return null;
        }

        // $description = preg_replace('/\<(.*?)\>\s\<\/(.*?)\>/mi', '', $description);
        // $description = preg_replace('/\*\*(.*?)\*\*/mi', '<b>${1}</b>', $description);
        // $description = preg_replace('~\[media=(.*?)\]~s', '<img src="${1}" alt="' . $file->name . '" />', $description);
        // $description = trim('<p>' . preg_replace(["/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", "</p>\n<p>", '${1}<br />${2}'], trim($description)) . '</p>');

        return trim($description);
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