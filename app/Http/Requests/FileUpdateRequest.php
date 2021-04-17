<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
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
            'description' => ['nullable', 'max:100000'],
            'cover' => ['nullable', 'image', 'max:5120'],
            'version' => ['nullable', 'max:16'],
            'custom-url' => ['nullable', 'unique:files,custom_url', 'not_in:submit,add,delete,edit'],
            'donation-url' => ['nullable', 'url', 'max:100'],
            'keywords' => ['nullable', 'max:500']
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
            'name.required' => 'Укажите название',
            'name.min' => 'Минимальная длинна короткого заголовка: 3 символа',
            'name.max' => 'Максимальная длинна короткого заголовка: 20 символов',
            'description.max' => 'Слишком длинное описание',
            'cover.image' => 'Обложкой может быть только изображение',
            'cover.max' => 'Максимальный размер обложки: 5 МБ',
            'version.max' => 'Слишком длинное значение версии',
            'custom-url.unique' => 'Указанная ссылка уже используется',
            'custom-url.not_in' => 'Указанная ссылка уже используется',
            'donation-url.url' => 'Неверный формат ссылки для пожертвований',
            'donation-url.max' => 'Слишком длинная ссылка для пожертвований',
            'keywords.max' => 'Слишком длинное значение ключевых слов'
        ];
    }
}