<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HCaptcha
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('h-captcha-response')) {
            abort(403);
        }

        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://hcaptcha.com/siteverify', [
            'response' => $request->get('h-captcha-response'),
            'secret' => config('mcm.hcaptcha.secret_key')
        ]);

        if (!$response->ok()) {
            abort(502);
        }

        if ($response->json('success')) {
            return $next($request);
        } else {
            return back()->withErrors([
                'h-captcha-response' => 'Вы что, робот?'
            ]);
        }
    }
}
