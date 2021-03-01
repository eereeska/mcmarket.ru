<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;

class FileDescriptionController extends Controller
{
    public static function normalize($description)
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

        // $description = preg_replace('/\<(.*?)\>\s\<\/(.*?)\>/mi', '', $description);
        // $description = preg_replace('/\*\*(.*?)\*\*/mi', '<b>${1}</b>', $description);
        // $description = preg_replace('~\[media=(.*?)\]~s', '<img src="${1}" alt="' . $file->name . '" />', $description);
        // $description = trim('<p>' . preg_replace(["/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"], ["</p>\n<p>", "</p>\n<p>", '${1}<br />${2}'], trim($description)) . '</p>');

        return trim($description);
    }
}