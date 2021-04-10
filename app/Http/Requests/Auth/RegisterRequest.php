<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash', 'unique:users,name'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Укажите желаемый никнейм',
            'username.min' => 'Никнейм не может быть короче трёх символов',
            'username.max' => 'Никнейм не может быть длиннее 20 символов',
            'username.alpha_dash' => 'Никнейм может состоять лишь из букв, цифр, нижнего подчёркивания, тире и не должен содержать пробелов',
            'username.unique' => 'Указанный никнейм уже используется',
            'password.required' => 'Укажите пароль',
            'password.min' => 'Минимальная длинна: 6 символов'
        ];
    }
}
