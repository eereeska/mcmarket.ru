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
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['wrong_credentials' => 'Неверный логин или пароль'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}