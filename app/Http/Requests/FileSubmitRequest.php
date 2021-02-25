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
            'name' => ['required', 'min:3', 'max:20'],
            'type' => ['required', 'in:free,paid,nulled'],
            'file' => ['required', 'file', 'max:102400'],
            'price' => ['nullable', 'numeric', 'min:1']
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
            'name.required' => 'Укажите короткий заголовок',
            'name.min' => 'Минимальная длинна короткого заголовка: 3 символа',
            'name.max' => 'Максимальная длинна короткого заголовка: 20 символов',
            'type.required' => 'Укажите тип файл',
            'type.in' => 'Тип файла имеет неверное значение',
            'file.required' => 'Укажите файл',
            'file.file' => 'Файл имеет неверный формат',
            'file.max' => 'Максимальный размер файла: 100 МБ',
            'price.numeric' => 'Цена указана в неверном формате',
            'price.min' => 'Стоимость не может быть ниже 1 рубля'
        ];
    }
}