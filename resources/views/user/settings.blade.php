@extends('layouts.app')

@section('meta.title', 'Настройки')

@section('content')
<div class="flex flex-wrap gap-x-10 gap-y-6 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <aside class="w-full lg:w-1/3">
        <section class="mb-8">
            <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}" class="rounded-md">
        </section>
        <section class="mb-8">
            <button type="submit" class="sticky bottom-3 w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Сохранить</button>
        </section>
    </aside>
    <main class="w-full">
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <div id="avatar" class="mb-6">
                <label for="avatar" class="block mb-3 text-gray-500">Аватар</label>
                <input type="file" name="avatar" accept="image/*" value="{{ $user->avatar }}" class="w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($errors->has('avatar'))
                    <p class="mt-2 text-red-600">{{ $errors->first('avatar') }}</p>
                @endif
            </div>
            <div id="about" class="mb-6">
                <label for="about" class="block mb-3 text-gray-500">Обо мне</label>
                <textarea name="about" rows="5" placeholder="Я здесь, чтобы совершить революцию" class="w-full border rounded-md bg-white px-4 py-4 focus:outline-none focus:ring-2 focus:border-blue-300">{{ $user->settings->about }}</textarea>
                @if ($errors->has('about'))
                    <p class="mt-2 text-red-600">{{ $errors->first('about') }}</p>
                @endif
            </div>
            <div id="about" class="mb-6">
                <label for="a" class="block mb-3 text-gray-500">Приватность</label>
                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="is_search_engine_visible" name="is_search_engine_visible" type="checkbox" class="text-blue-500 focus:ring-indigo-400">
                        <label for="is_search_engine_visible" class="ml-2 font-medium text-gray-700">Профиль можно найти в поиске Google, Яндекс и т.д.</label>
                    </div>
                    <p class="mt-2 ml-7 text-sm text-gray-500">Требуется время, чтобы изменения вступили в силу</p>
                </div>
                @if ($errors->has('about'))
                    <p class="mt-2 text-red-600">{{ $errors->first('about') }}</p>
                @endif
            </div>
        </form>
    </main>
</div>
@endsection