<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'name' => ['required', 'unique:users', 'min:3', 'max:20', 'regex:^(?=.{3,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$'],
            'password' => ['required', 'confirmed', 'min:6']
        ], [
            'name.required' => 'Обязательное поле',
            'name.unique' => 'Указанный никнейм уже используется',
            'name.min' => 'Минимальная длинна: 3 символа',
            'name.max' => 'Максимальная длинна: 20 символа',
            'name.regex' => 'Неверный формат',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Минимальная длинна: 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user, true);

        return redirect()->route('home');
    }
}