<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileVersionSubmitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => ['required', 'file', 'max:102400'],
            'version' => ['nullable', 'max:10'],
            'description' => ['nullable', 'max:50000']
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Укажите файл',
            'file.file' => 'Указан неверный файл',
            'file.max' => 'Максимальный размер файла: 100 МБ',
            'version.max' => 'Максимальная длинна версии: 10 символов',
            'description.max' => 'Максимальная длинна описания: 50.000 символов'
        ];
    }
}