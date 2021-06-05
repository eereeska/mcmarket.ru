<?php

namespace App\Services\Files;

use App\Models\Files\FileVersion;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Storage;

class FileService {

    // private File $file;

    // public function __construct(File $file)
    // {
    //     $this->file = $file;
    // }

    public function save(UploadedFile $file) : bool|array
    {
        $hash = hash_file('sha256', $file);
        $extension = $file->getClientOriginalExtension();

        if ($existed_file_version = FileVersion::where('hash', $hash)->with('file')->first()) {
            return [
                'success' => false,
                'errors' => [
                    'file_already_exists' => 'Указанный файл уже был существует в базе данных'
                ],
                'flash' => [
                    'existed_file' => $existed_file_version->file
                ]
            ];
        }

        if ($path = Storage::putFileAs('files', $file, $hash . '.' . $extension)) {
            return [
                'success' => true,
                'path' => $path,
                'hash' => $hash,
                'extension' => $extension,
                'size' => $file->getSize()
            ];
        }

        return [
            'success' => false,
            'errors' => [
                'file_save_error' => 'Не удалось сохранить файл на сервере'
            ]
        ];
    }

    public function normalizeDescription(string $description)
    {
        $description = trim($description);

        $allowed_tags = [
            'p', 'b', 'u', 's', 'ul', 'li', 'ol', 'br'
        ];

        $description = strip_tags($description, $allowed_tags);

        $description = preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $description);
        $description = preg_replace('/\<p\>\<\/p\>/i', '', $description);
        $description = preg_replace('/\<p\>\<br\>\<\/p\>/i', '', $description);
        $description = preg_replace('/\<p\>\<br \/\>\<\/p\>/i', '', $description);

        if (empty($description)) {
            return null;
        }

        return trim($description);
    }

    public function formatDescription(string $description)
    {
        $text = strip_tags($description, '<br><p><li>');
    $text = preg_replace ('/<[^>]*>/', PHP_EOL, $text);

    dd($text);
        dd(preg_replace( "/\n\s+/", "\n", rtrim(html_entity_decode(strip_tags($description))) ));
        return Markdown::parse($description);
    }
}