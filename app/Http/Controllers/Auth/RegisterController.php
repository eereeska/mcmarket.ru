<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users', 'min:3', 'max:20'],
            'password' => ['required', 'confirmed', 'min:6']
        ], [
            'name.required' => 'Обязательное поле',
            'name.unique' => 'Указанный никнейм уже используется',
            'name.min' => 'Минимальная длинна: 3 символа',
            'name.max' => 'Максимальная длинна: 20 символа',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Минимальная длинна: 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        // TODO: проверку ника по regex

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->ip = $_SERVER['CF_CONNECTING_IP'] ?? $request->ip();
            $user->save();
        } catch (\Exception $e) {
            return back()->withErrors(['create_error' => 'Не удалось создать аккаунт'])->withInput();
        }

        Auth::login($user, true);

        return redirect()->route('home');
    }
}