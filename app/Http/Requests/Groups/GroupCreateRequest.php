<?php

namespace App\Http\Requests\Groups;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class GroupCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:32', 'unique:groups,name'],
            'slug' => ['required', 'unique:groups,slug'],
            'cover' => ['required', 'image', 'max:5120'],
            'type' => ['required', 'in:public,closed,private'],
            'description' => ['nullable', function ($attribute, $value, $fail) {
                if (strlen(strip_tags($value)) <= 3) {
                    $fail('Слишком короткое описание');
                }
            }, function ($attribute, $value, $fail) {
                if (strlen(strip_tags($value)) > 100) {
                    $fail('Слишком длинное описание');
                }
            }]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название',
            'name.min' => 'Минимальная длинна названия:24 символа',
            'name.max' => 'Максимальная длинна названия: 32 символа',
            'name.unique' => 'Указанное название уже использовается',
            'slug.required' => 'Укажите название',
            'slug.unique' => 'Указанное название уже использовается',
            'cover.required' => 'Загрузите обложку сообщества',
            'cover.image' => 'Неверный формат обложки',
            'cover.max' => 'Максимальный размер обложки: 5 МБ',
            'type.required' => 'Укажите тип сообщества',
            'type.in' => 'Неверные параметры запроса'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }
}
