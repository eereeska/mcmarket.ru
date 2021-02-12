<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileSubmitRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileMedia;
use App\Models\FilePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $categories = $this->getCategories();

        $files = File::when($request->has('category') and in_array($request->category, $categories->pluck('name')->toArray()), function($query) use ($request, $categories) {
            return $query->where('category_id', $categories->where('name', $request->category)->pluck('id'));
        })->with(['category', 'user'])->orderBy('created_at', 'desc')->paginate(20)->appends($request->only('category'));

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
            'categories' => $this->getCategories()
        ]);
    }

    public function store(FileSubmitRequest $request)
    {
        $user = $request->user();

        $request_file = $request->file('file');
        $request_file_extension = $request_file->getClientOriginalExtension();

        // if ($request->type != 'paid') {
        //     $vt_analyse_response = Http::withHeaders([
        //         'x-apikey' => $this->vt_key
        //     ])->attach('file', file_get_contents($request_file), $request->short_title)->post('https://www.virustotal.com/api/v3/files');
    
        //     if ($vt_analyse_response->failed() or array_key_exists('error', $vt_analyse_response->json())) {
        //         return back()->withErrors(['vt_error' => 'Не удалось загрузить файл для проверки на VirusTotal'])->withInput($request->all());
        //     }
        // }

        $category = FileCategory::where('name', $request->category)->first();

        $file = new File();
        $file->category_id = $category->id;
        $file->user_id = $user->id;
        $file->title = $request->title;
        $file->short_title = $request->short_title;
        $file->slug = Str::slug($file->short_title);
        $file->type = $request->type;
        $file->size = $request_file->getSize();
        $file->extension = $request_file_extension;

        if ($request->type == 'paid') {
            $file->price = $request->price;
        } else if (isset($vt_analyse_response)) {
            $file->vt_id = $vt_analyse_response->json()['data']['id'];
        }

        $file->save();

        if (!$request_file->storeAs('files', $file->id . '.' . $request_file_extension)) {
            $file->delete();
            return back()->withErrors(['store_error' => 'Не удалось сохранить файл на сервере'])->withInput($request->all());
        }

        return redirect()->route('file-show', ['file' => $file]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $file = Cache::remember('file.' . $id, now()->addHour(), function() use ($id) {
            return File::where('id', $id)->with(['category', 'media', 'user'])->withCount(['media', 'purchases'])->firstOrFail();
        });

        $cache_key = 'file.' . $id . '.view.' . ($_SERVER['CF_CONNECTING_IP'] ?? $request->ip());

        if (!Cache::has($cache_key)) {
            Cache::put($cache_key, $id, now()->addHour());

            $file->increment('views_count');
        }

        $file->description_raw = strip_tags($file->description);

        // $this->updateVirusTotalStatus($file);

        return view('files.show', [
            'file' => $file
        ]);
    }

    public function download(Request $request, File $file)
    {
        if ($file->type == 'paid' and !$request->user()->hasPurchasedFile($file)) {
            return back()->withErrors(['purchase_required' => 'Вы должны сначала приобрести указанный файл']);
        }

        $file->increment('downloads_count');

        return response()->download(storage_path('app/' . $file->path), $file->short_title . '.' . $file->extension);
    }

    public function edit(File $file)
    {
        if ($file->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('files.edit', [
            'file' => $file,
            'categories' => $this->getCategories()
        ]);
    }

    public function update(FileUpdateRequest $request, $id)
    {
        $user = $request->user();

        $file = File::where('id', $id)->where('user_id', $user->id)->withCount('media')->firstOrFail();

        $file->title = trim($request->title);
        $file->short_title = trim($request->short_title);
        $file->type = $request->type;
        $file->price = $request->price;

        if ($request->has('description')) {
            $file->description = empty($request->description) ? null : trim($request->description);
        }

        if ($request->has('version')) {
            $file->version = trim($request->version);
        }

        if ($request->has('custom_url')) {
            $file->slug = Str::slug(trim($request->custom_url));
        }

        if ($request->has('donation_url')) {
            $file->donation_url = trim($request->donation_url);
        }

        if ($request->has('keywords')) {
            $file->keywords = trim($request->keywords);
        }

        if ($request->has('cover')) {
            $cover = $request->file('cover');
            $cover_height = Image::make($cover)->height();

            if (!is_null($file->cover_path)) {
                Storage::delete($file->cover_path);
            }

            $path = Str::random(40) . '.' . $cover->getClientOriginalExtension();

            Image::make($cover)->fit(300, $cover_height > 300 ? ($cover_height < 3000 ? $cover_height : 3000) : 300)->save(storage_path('app/public/covers/' . $path));

            $file->cover_path = $path;
        }

        $file->is_visible = !is_null($file->description);

        $file->save();

        Cache::forget('file.' . $file->id);

        return redirect()->route('file.show', ['file' => $file]);
    }

    public function addMedia(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'media-images' => ['nullable'],
            'media-images.*' => ['image', 'max:5020']
        ], [
            'media-images.*.image' => 'Один из загруженных файлов не является изображением',
            'media-images.*.max' => 'Максимальный размер загружаемого изображения: 5 МБ'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user = $request->user();
        $file = File::where('id', $id)->where('user_id', $user->id)->withCount('media')->firstOrFail();

        if ($file->media_count >= 20) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можеет добавлять более 20 медиа-файлов'
            ]);
        }

        if ($request->has('media-images')) {
            foreach ($request->file('media-images') as $image) {
                $name = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $image->storeAs('public/media', $name);

                $media = new FileMedia();
                $media->file_id = $file->id;
                $media->name = $name;
                $media->type = 'image';
                $media->save();
            }
        }

        return response()->json([
            'success' => true,
            'preview' => view('components.files._media', [
                'media' => FileMedia::where('file_id', $file->id)->get()
            ])->render()
        ]);
    }

    public function deleteMedia(Request $request, $file_id, $id)
    {
        $media = FileMedia::where('file_id', $file_id)->where('id', $id)->with('file')->firstOrFail();
        $user = $request->user();

        if ($media->file->user_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете удалить этот медиа-файл'
            ]);
        }

        if (Storage::delete('public/media/' . $media->name)) {
            $media->delete();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось удалить файл'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $file = File::where('id', $id)->first();

        if ($user->id != $file->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете удалить указанный файл'
            ]);
        }

        Storage::delete('app/files/' . $file->id . '.' . $file->extension);
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

    private function getCategories($fresh = false)
    {
        $cache_key = 'file.categories';

        if ($fresh) {
            Cache::forget($cache_key);
        }

        return Cache::rememberForever($cache_key, function() {
            return FileCategory::orderBy('title')->get();
        });
    }

    private function generateFileName($file)
    {
        
    }

    private function formatDescription($file, $description)
    {
        $description = strip_tags($description);

        $description = preg_replace('/\*\*(.*?)\*\*/mi', '<b>${1}</b>', $description);
        $description = preg_replace('~\[media=(.*?)\]~s', '<img src="${1}" alt="' . $file->short_title . '" />', $description);
        $description = trim('<p>' . preg_replace(["/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", "</p>\n<p>", '${1}<br />${2}'], trim($description)) . '</p>');

        return trim($description);
    }

    private function nl2p($string, $line_breaks = true, $xml = true)
    {
        $string = strip_tags($string);
        
        if ($line_breaks == true) {
            $string = trim('<p>' . preg_replace(["/([\n]{2,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", '${1}<br' . ($xml == true ? ' /' : '') . '>${2}'], trim($string)) . '</p>');
        } else {
            $string = trim('<p>' . preg_replace(["/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", "</p>\n<p>", '${1}<br' . ($xml === true ? ' /' : '') . '>${2}'], trim($string)) . '</p>'); 
        }

        $string = preg_replace('/\*\*(.*?)\*\*/i', '<b>${1}</b>', $string);

        return $string;
    }
}