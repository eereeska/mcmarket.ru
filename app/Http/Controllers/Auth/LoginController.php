<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'name' => $request->username,
            'password' => $request->password
        ], true)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        } else {
            return back()->withErrors(['wrong_credentials' => 'Неверный логин или пароль']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('home');
    }
}