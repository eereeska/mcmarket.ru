<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileMediaController extends Controller
{
    public function store(Request $request, $id)
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

    public function destroy(Request $request, $file_id, $id)
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
}