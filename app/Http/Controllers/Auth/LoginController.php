<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required']
        ], [
            'username.required' => 'Обязательное поле',
            'password.required' => 'Обязательное поле'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if (Auth::attempt([
            'name' => $request->username,
            'password' => $request->password
        ], true)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        } else {
            return back()->withErrors(['wrong_credentials' => 'Неверный логин или пароль'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('home');
    }
}