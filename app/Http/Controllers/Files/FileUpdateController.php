<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileVersionSubmitRequest;
use App\Models\File;
use Illuminate\Support\Facades\Cache;

class FileUpdateController extends Controller
{
    public function submit($id)
    {
        $file = File::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$file) {
            return back();
        }

        return view('files.updates.submit', [
            'file' => $file
        ]);
    }

    public function store(FileVersionSubmitRequest $request, $id)
    {
        $file = File::where('id', $id)->first();

        $request_file = $request->file('file');
        $request_file_extension = $request_file->getClientOriginalExtension();

        $path = FileController::save($request_file, $file->path);

        if (!$path) {
            return back()->withErrors(['save_error' => 'Не удалось сохранить файл на сервере'])->withInput($request->all());
        }

        $file->update([
            'description' => FileController::normalizeDescription($request->get('description')),
            'version' => $request->get('version'),
            'extension' => $request_file_extension,
            'path' => $path,
            'size' => $request_file->getSize(),
            'version_updated_at' => now()
        ]);
        
        Cache::forget('file.' . $file->id);

        return redirect()->route('file.show', ['id' => $file]);
    }
}