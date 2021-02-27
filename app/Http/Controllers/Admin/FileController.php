<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Files\FileCategoryController;
use App\Http\Controllers\Files\FileFilterController;
use App\Models\File;
use Illuminate\Http\Request;

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