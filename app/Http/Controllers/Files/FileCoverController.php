<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileCoverController extends Controller
{
    public static function store($file, $cover, $hash = 'md5', $width = 300, $height = 300)
    {
        if (!is_null($file->cover_path)) {
            Storage::delete('public/covers/' . $file->cover_path);
        }

        $path = hash_file($hash, $cover) . '.' . $cover->getClientOriginalExtension();

        // TODO: Доработать пути, кеш и сделать сохранение нескольких версий, разных размеров

        try {
            Image::make($cover)->fit($width, $height)->save(storage_path('app/public/covers/files/' . $path));
        } catch(\Exception $e) {
            return null;
        }

        return $path;
    }
}