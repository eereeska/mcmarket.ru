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
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash', 'unique:users,name'],
            'password' => ['required', 'min:6']
        ], [
            'username.required' => 'Обязательное поле',
            'username.min' => 'Никнейм не может быть короче трёх символов',
            'username.max' => 'Никнейм не может быть длиннее 20 символов',
            'username.alpha_dash' => 'Никнейм может состоять лишь из букв, цифр, нижнего подчёркивания, тире и не должен содержать пробелов',
            'username.unique' => 'Указанный никнейм уже используется',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Минимальная длинна: 6 символов'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            return back()->withErrors(['create_error' => 'Не удалось создать аккаунт'])->withInput();
        }
    }
}
