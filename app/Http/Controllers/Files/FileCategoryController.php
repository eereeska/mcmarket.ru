<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\Files\FileCategory;
use Illuminate\Support\Facades\Cache;

class FileCategoryController extends Controller
{
    public static function getCategories($fresh = false)
    {
        $cache_key = 'file.categories';

        if ($fresh) {
            Cache::forget($cache_key);
        }

        return Cache::rememberForever($cache_key, function() {
            return FileCategory::orderBy('title')->get();
        });
    }
}