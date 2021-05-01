<?php

namespace App\Http\Requests\Files;

use App\Services\Files\FileService;
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
            'title' => ['required', 'min:3', 'max:80'],
            'name' => ['required', 'min:3', 'max:20'],
            'cover' => ['nullable', 'image', 'max:5120'],
            'description' => ['required', 'string', 'max:100000'],
            'description_raw' => ['min:5'],
            'file' => ['required', 'file', 'max:5120'],
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
            'title.max' => 'Максимальная длинна заголовка: 80 символов',
            'name.required' => 'Укажите короткий заголовок',
            'name.min' => 'Минимальная длинна короткого заголовка: 3 символа',
            'name.max' => 'Максимальная длинна короткого заголовка: 20 символов',
            'cover.image' => 'Неверный формат',
            'cover.max' => 'Максимальный размер: 5 МБ',
            'description.max' => 'Максимальная длинна 100000 символов',
            'description_raw.min' => 'Слишком короткое описание',
            'file.required' => 'Укажите файл',
            'file.file' => 'Не удалось загрузить файл',
            'file.max' => 'Используйте файлообменники для добавления файлов, размер которых превышает 5 МБ',
            'price.numeric' => 'Цена указана в неверном формате',
            'price.min' => 'Стоимость не может быть ниже 1 рубля'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'description' => (new FileService())->normalizeDescription($this->description)
        ]);

        $this->merge([
            'description_raw' => strip_tags($this->description)
        ]);
    }
}