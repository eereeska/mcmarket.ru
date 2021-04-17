@extends('layouts.app')

@section('meta.title', 'Обновление файла ' . $file->name)
@section('meta.robots', 'noindex')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full">
        <ol class="inline-flex mb-6 font-semibold">
            <li class="hover:text-blue-500">
                <a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a>
            </li>
            <li class="mx-2">
                <i class="far fa-angle-right"></i>
            </li>
            <li class="hover:text-blue-500">
                <a href="{{ route('file.edit', ['id' => $file->id]) }}">Редактирование</a>
            </li>
            <li class="mx-2">
                <i class="far fa-angle-right"></i>
            </li>
            <li class="text-gray-500">Обновление</li>
        </ol>
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="file" class="block mb-3 text-gray-500">Новый файл <span class="text-red-500">*</span></label>
                <input type="file" name="file" required class="w-full">
                @if ($errors->has('file'))
                    <p class="mt-2 text-red-600">{{ $errors->first('file') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="version" class="block mb-3 text-gray-500">Версия <span class="text-red-500">*</span></label>
                <input type="text" name="version" placeholder="От 1 до 6 символов" value="{{ $file->version ?? old('version') }}" required minlength="1" maxlength="6" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('version'))
                    <p class="mt-2 text-red-600">{{ $errors->first('version') }}</p>
                @endif
            </div>
            <label for="description" class="block mb-3 text-gray-500">Описание</label>
            <div contenteditable="true" spellcheck="true" data-name="description" class="bg-white border rounded-md px-3 py-2 space-y-3 focus:outline-none focus:ring-2 focus:border-blue-500">{!! $file->description ?? '<p>Самое скучное описание...</p>' !!}</div>
            @if ($errors->has('description'))
                <p class="mt-2 text-red-600">{{ $errors->first('description') }}</p>
            @endif
        </form>
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="sticky top-6">
            <div class="mb-6">
                @if ($file->cover_path)
                    <img src="{{ $file->getCover() }}" alt="{{ $file->title }}" class="rounded-md">
                @else
                    <a href="{{ route('file.edit', ['id' => $file->id, '#cover']) }}" class="w-full bg-gray-200 rounded-md px-2 py-2 font-semibold">Добавьте обложку</a>
                @endif
            </div>
            <button type="submit" class="sticky bottom-3 w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Опубликовать</button>
        </div>
    </aside>
</div>
@endsection