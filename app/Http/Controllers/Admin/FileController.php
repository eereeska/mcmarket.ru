<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        return view('admin.files.edit', [
            'file' => File::where('id', 1)->firstOrFail()
        ]);
    }

    public function edit($id)
    {
        return view('admin.files.edit', [
            'file' => File::where('id', $id)->firstOrFail()
        ]);
    }
}