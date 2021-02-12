<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileSubmitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category' => ['required', 'exists:file_categories,name'],
            'title' => ['required', 'min:3', 'max:60'],
            'short_title' => ['required', 'min:3', 'max:20'],
            'type' => ['required', 'in:free,paid,nulled'],
            'file' => ['required', 'file', 'max:102400']
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Укажите категорию',
            'category.exists' => 'Указана несуществующая категория',
            'title.required' => 'Укажите заголовок',
            'title.min' => 'Минимальная длинна заголовка: 3 символа',
            'title.max' => 'Максимальная длинна заголовка: 60 символов',
            'short_title.required' => 'Укажите короткий заголовок',
            'short_title.min' => 'Минимальная длинна короткого заголовка: 3 символа',
            'short_title.max' => 'Максимальная длинна короткого заголовка: 20 символов',
            'type.required' => 'Укажите тип файл',
            'type.in' => 'Тип файла имеет неверное значение',
            'file.required' => 'Укажите файл',
            'file.file' => 'Файл имеет неверный формат',
            'file.max' => 'Максимальный размер файла: 100 МБ'
        ];
    }
}