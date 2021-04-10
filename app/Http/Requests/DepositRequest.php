<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:1', 'max:50000']
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Укажите сумму пополнения',
            'amount.numeric' => 'Указана неверная сумма пополнения',
            'amount.min' => 'Минимальная сумма пополнения: 1 рубль',
            'amount.max' => 'Максимальная сумма пополнения: 50.000 рублей'
        ];
    }
}
