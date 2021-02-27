<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserFileController extends Controller
{
    public function index(Request $request)
    {
        $categories = FileCategoryController::getCategories();

        return view('files.user.index', [
            'categories' => $categories,
            'files' => FileFilterController::filter($request, $categories, auth()->user(), false)
        ]);
    }
}