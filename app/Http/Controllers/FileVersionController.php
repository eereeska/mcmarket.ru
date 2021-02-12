<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileVersionSubmitRequest;
use App\Models\File;
use App\Models\FileVersion;
use Illuminate\Support\Facades\Cache;

class FileVersionController extends Controller
{
    public function submit(File $file)
    {
        return view('files.versions.submit', [
            'file' => $file
        ]);
    }

    public function store(FileVersionSubmitRequest $request, File $file)
    {
        $request_file = $request->file('file');
        $request_file_extension = $request_file->getClientOriginalExtension();

        $request_file->storeAs('files', $file->id . '.' . $request_file_extension);

        $file->update([
            'version' => $request->version,
            'extension' => $request_file_extension,
            'size' => $request_file->getSize(),
            'version_updated_at' => now()
        ]);
        
        FileVersion::create([
            'file_id' => $file->id,
            'version' => $request->version
        ]);

        Cache::forget('file.' . $file->id);

        return redirect()->route('file-show', ['file' => $file]);
    }
}