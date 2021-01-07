<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ], true)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        } else {
            return back()->withErrors(['wrong_credentials' => 'Неверный логин или пароль'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}