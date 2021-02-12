<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VirusTotalController extends Controller
{
    public static function updateStatus(File $file, $force = false)
    {
        if ($file->type == 'paid' or is_null($file->vt_id) or ($file->vt_status == 'completed' and !$force)) {
            return false;
        }

        $request = Http::withHeaders([
            'x-apikey' => config('mcm.vt.apikey')
        ])->get('https://www.virustotal.com/api/v3/analyses/' . $file->vt_id);

        $response = $request->json();

        if ($request->ok() and array_key_exists('data', $response) and array_key_exists('meta', $response)) {
            $file->vt_status = $response['data']['attributes']['status'];
            $file->vt_stats = $response['data']['attributes']['stats'];
            $file->vt_hash = $response['meta']['file_info']['sha256'];

            $file->save();

            return true;
        }
    }
}