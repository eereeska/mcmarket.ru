<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReCaptcha
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('g-recaptcha-response')) {
            abort(403);
        }

        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://www.google.com/recaptcha/api/siteverify', [
            'response' => $request->get('g-recaptcha-response'),
            'secret' => config('services.recaptcha.secret'),
            'remoteip' => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $request->ip()
        ]);

        if (!$response->ok()) {
            abort(502);
        }

        if ($response->json('success')) {
            return $next($request);
        } else {
            return back()->withErrors([
                'g-recaptcha-response' => 'Вы что, робот?'
            ]);
        }
    }
}
