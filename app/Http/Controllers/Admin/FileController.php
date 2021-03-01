<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Files\FileFilterController;
use App\Http\Controllers\Files\FileCategoryController;
use App\Http\Controllers\Files\FileCoverController;
use App\Http\Controllers\Files\FileDescriptionController;
use Illuminate\Support\Facades\Cache;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $categories = FileCategoryController::getCategories();
        $files = FileFilterController::filter($request, $categories, null, false);

        if ($request->ajax()) {
            return response()->json(view('components.files._files', [
                'files' => $files
            ])->render());
        }

        return view('admin.files.index', [
            'categories' => $categories,
            'files' => $files
        ]);
    }

    public function edit($id)
    {
        return view('admin.files.edit', [
            'categories' => FileCategoryController::getCategories(),
            'file' => File::where('id', $id)->firstOrFail()
        ]);
    }

    public function update(Request $request, $id)
    {
        $file = File::where('id', $id)->first();

        if (!$file) {
            return back()->withErrors(['not_found' => 'Файл не найден'])->withInput($request->validated());
        }

        $file->is_visible = $request->boolean('is_visible');
        $file->is_approved = $request->boolean('is_approved');

        $file->title = trim($request->title);
        $file->name = trim($request->name);
        $file->description = FileDescriptionController::normalize($request->description);
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
            $file->cover_path = FileCoverController::store($file, $request->file('cover'));
        }

        $file->save();

        Cache::forget('file.' . $file->id);

        return redirect()->route('admin.file.edit', ['id' => $file->id]);
    }

    public function approve(Request $request, $id)
    {
        $file = File::where('id', $id)->first();

        $file->is_approved = $request->boolean('checked');

        $file->save();

        return response()->json([
            'success' => true
        ]);
    }
}