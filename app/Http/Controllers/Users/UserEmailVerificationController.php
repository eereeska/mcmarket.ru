<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class UserEmailVerificationController extends Controller
{
    public static function sendEmail($user)
    {
        // if (!is_null($user->email_verified_at)) {
        //     return;
        // }

        Cache::put('user.' . $user->id . '.mail.verification.token', sha1($user->email));

        Mail::to($user)->send(new VerificationMail($user));
    }

    public function verify()
    {
        $user = auth()->user();

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('home');
        }

        $cache_key = 'user.' . auth()->id() . '.mail.verification.token';

        if (!Cache::has($cache_key)) {
            return redirect()->route('home');
        }

        if (sha1($user->email) != Cache::get($cache_key)) {
            return redirect()->route('home');
        }

        $user->email_verified_at = now();
        $user->save();

        Cache::forget($cache_key);

        return redirect()->route('home');
    }
}