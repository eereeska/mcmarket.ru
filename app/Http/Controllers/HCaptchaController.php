<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class HCaptchaController extends Controller
{
    public static function verify($token)
    {
        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://hcaptcha.com/siteverify', [
            'response' => $token,
            'secret' => config('mcm.hcaptcha.secret_key')
        ]);

        if ($response->ok()) {
            return $response->json('success');
        } else {
            return false;
        }
    }
}
