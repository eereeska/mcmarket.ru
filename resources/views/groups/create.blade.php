@extends('layouts.app')

@section('meta.title', 'Создание сообщества')
@section('meta.robots', 'noindex')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full md:w-2/5 mx-auto">
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-3 text-gray-500">Уникальное название <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="От 2 до 32 символов" value="{{ old('name') }}" required minlength="2" maxlength="32" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('name'))
                    <p class="mt-2 text-red-600">{{ $errors->first('name') }}</p>
                @endif
                @if ($errors->has('slug'))
                    <p class="mt-2 text-red-600">{{ $errors->first('slug') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="cover" class="block mb-3 text-gray-500">Обложка <span class="text-red-500">*</span></label>
                <input type="file" name="cover" accept="image/*" required class="w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($errors->has('cover'))
                    <p class="mt-2 text-red-600">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-3 text-gray-500">Описание</label>
                <div contenteditable="true" spellcheck="true" data-name="description" class="bg-white border rounded-md px-3 py-2 space-y-3 focus:outline-none focus:ring-2 focus:border-blue-500"></div>
                @if ($errors->has('description'))
                    <p class="mt-2 text-red-600">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="type" class="block mb-3 text-gray-500">Тип <span class="text-red-500">*</span></label>
                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="group-type-public" type="radio" name="type" value="public" required class="text-blue-500 focus:ring-indigo-400">
                        <label for="group-type-public" class="ml-2 font-medium text-gray-700">Публичное</label>
                    </div>
                    <p class="mt-2 ml-7 text-sm text-gray-500">Любой может вступить, отображается в общем списке сообществ</p>
                </div>
                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="group-type-closed" type="radio" name="type" value="closed" required class="text-blue-500 focus:ring-indigo-400">
                        <label for="group-type-closed" class="ml-2 font-medium text-gray-700">Закрытое</label>
                    </div>
                    <p class="mt-2 ml-7 text-sm text-gray-500">По одобрению, отображается в общем списке сообществ</p>
                </div>
                <div class="mb-4">
                    <div class="flex items-center">
                        <input id="group-type-private" type="radio" name="type" value="private" required class="text-blue-500 focus:ring-indigo-400">
                        <label for="group-type-private" class="ml-2 font-medium text-gray-700">Приватное</label>
                    </div>
                    <p class="mt-2 ml-7 text-sm text-gray-500">По приглашению, не отображается в общем списке сообществ</p>
                </div>
                @if ($errors->has('type'))
                    <p class="mt-2 text-red-600">{{ $errors->first('type') }}</p>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Создать сообщество</button>
        </form>
    </main>
</div>
{{-- <div class="content">
            <div class="section__content">
                <label class="file">
                    <input type="file" name="file" class="file__original" multiple>
                    <span class="file__label">Нажмите здесь или перетащите файл</span>
                </label>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Комментарий для администрации</h2>
            </div>
            <div class="section__content">
                <textarea name="comment" placeholder="">{{ old('comment') }}</textarea>
            </div>
        </section>
        <section class="section">
            <h2 class="section__title section__title_required">Обложка</h2>
            <label class="file">
                <input type="file" name="cover" accept="image/*" class="file__original">
                <span class="file__label">Нажмите здесь или перетащите изображение</span>
            </label>
        </section>
        <section class="section">
            <h2 class="section__title">Изображения</h2>
            <label class="file">
                <input type="file" name="images" accept="image/*">
                <span class="file__label">Нажмите здесь или перетащите изображения для загрузки</span>
            </label>
        </section>
        <section class="section">
            <h2 class="section__title">Версия</h2>
            <input type="text" name="version" placeholder="1.0.0" autocorrect="off" autocomplete="off">
        </section>
        <section class="section">
            <h2 class="section__title">Собственная ссылка</h2>
            <input type="text" name="custom-url" placeholder="my-custom-url" autocorrect="off" autocomplete="off">
        </section>
        <section class="section">
            <h2 class="section__title">Ссылка для пожертвований</h2>
            <input type="text" name="donation-url" placeholder="paypal.me/mcmarket" autocorrect="off" autocomplete="off">
        </section>
        <section class="section">
            <h2 class="section__title">Ключевые слова</h2>
            <input type="text" name="keywords" placeholder="Мой первый плагин, Бесплатно" autocomplete="off">
        </section>
    </form>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Шаг 1/2</h2>
            </div>
            <div class="section__content">
                <p>После внесения всей необходимой информации, администрация вручную проверит сам файл и его описание на соответствие с <a href="{{ route('terms') }}" class="dashed" target="_blank">правилам сообщества</a></p>
            </div>
        </section>
        <section class="section">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button class="button primary" data-submit="#file-submit-form">Отправить на проверку</button>
        </section>
    </section>
</aside> --}}
@endsection