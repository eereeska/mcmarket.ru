<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->username,
                'password' => Hash::make($request->password),
                'ip' => $_SERVER['CF_CONNECTING_IP'] ?? $request->ip()
            ]);

            UserSettings::create([
                'user_id' => $user->id
            ]);

            Auth::login($user, true);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return back()->withErrors(['create_error' => 'Не удалось создать аккаунт']);
        }
    }
}
