<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends Controller
{
    private $vt_key = 'eb7a47b642b3a3467c60a1e4e0c3b215f71734f2550587d1c25a82c0fb5b6429';

    public function index()
    {
        $files = File::with('user')->get();

        return view('files.index', [
            'files' => $files,
            'categories' => $this->getCategories()
        ]);
    }

    public function submit()
    {
        return view('files.submit', [
            'categories' => $this->getCategories()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => ['required', 'exists:file_categories,name'],
            'title' => ['required', 'min:3', 'max:60'],
            'short_title' => ['required', 'min:3', 'max:20'],
            'type' => ['required', 'in:free,paid,nulled'],
            'file' => ['required', 'file', 'max:102400']
        ], [
            'category.required' => 'Укажите категорию',
            'category.exists' => 'Указана несуществующая категория',
            'title.required' => 'Укажите заголовок',
            'title.min' => 'Минимальная длинна заголовка: 3 символа',
            'title.max' => 'Максимальная длинна заголовка: 60 символов',
            'short_title.required' => 'Укажите короткий заголовок',
            'short_title.min' => 'Минимальная длинна короткого заголовка: 3 символа',
            'short_title.max' => 'Максимальная длинна короткого заголовка: 20 символов',
            'type.required' => 'Укажите тип файл',
            'type.in' => 'Тип файла имеет неверное значение',
            'file.required' => 'Укажите файл',
            'file.file' => 'Файл имеет неверный формат',
            'file.max' => 'Максимальный размер файла: 100 МБ'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }

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

        $file = DB::transaction(function() use ($request, $request_file, $request_file_extension, $user) {
            $file = new File();
            $file->category_id = FileCategory::where('name', $request->category)->first()->id;
            $file->user_id = $user->id;
            $file->title = $request->title;
            $file->short_title = $request->short_title;
            $file->slug = Str::slug($file->short_title);
            $file->type = $request->type;
            $file->size = $request_file->getSize();
            $file->extension = $request_file_extension;
            $file->path = $request_file->storeAs('files', Str::random(40) . '.' . $request_file_extension);

            // TODO: название файла

            if ($request->type == 'paid') {
                $file->price = $request->price;
            } else if (isset($vt_analyse_response)) {
                $file->vt_id = $vt_analyse_response->json()['data']['id'];
            }
    
            $file->save();

            return $file;
        });

        return redirect()->route('file-show', ['id' => $file->id]);
    }

    public function show(Request $request, $id)
    {
        $file = File::where('id', $id)->with(['category', 'user'])->firstOrFail();

        if (!Cache::has('file.' . $id . '.user.' . $request->user()->id . '.view')) {
            Cache::put('file.' . $id . '.user.' . $request->user()->id . '.view', $id, now()->addHour());

            $file->increment('views');
        }

        // $this->updateVirusTotalStatus($file);

        return view('files.show', [
            'file' => $file
        ]);
    }

    public function download($id)
    {
        $file = File::where('id', $id)->firstOrFail();
        
        $file->increment('downloads');

        return response()->download(storage_path('app/' . $file->path), $file->short_title . '.' . $file->extension);
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
        if ($fresh) {
            Cache::put('file.categories', 'remove', 0);
        }

        return Cache::rememberForever('file.categories', function() {
            return FileCategory::orderBy('title')->get();
        });
    }

    private function updateVirusTotalStatus($file, $force = false)
    {
        if ($file->type == 'paid' or is_null($file->vt_id) or ($file->vt_status == 'completed' and !$force)) {
            return;
        }

        $analyses = Http::withHeaders([
            'x-apikey' => $this->vt_key
        ])->get('https://www.virustotal.com/api/v3/analyses/' . $file->vt_id);

        $analyses_json = $analyses->json();

        if ($analyses->ok() and array_key_exists('data', $analyses_json) and array_key_exists('meta', $analyses_json)) {
            $file->vt_status = $analyses_json['data']['attributes']['status'];
            $file->vt_stats = $analyses_json['data']['attributes']['stats'];
            $file->vt_hash = $analyses_json['meta']['file_info']['sha256'];

            $file->save();
        }
    }
}