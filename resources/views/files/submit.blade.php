@extends('layouts.app')

@section('meta.title', 'Добавление файла')
@section('meta.robots', 'noindex')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full md:w-2/5 mx-auto">
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="mb-6">
                <label for="category" class="block mb-3 text-gray-500">Категория <span class="text-red-500">*</span></label>
                <select name="category" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left cursor-default focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option disabled selected value>Не указана</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" @if ($category->name == request()->get('category')) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <p class="mt-2 text-red-600">{{ $errors->first('category') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="title" class="block mb-3 text-gray-500">Заголовок <span class="text-red-500">*</span></label>
                <input type="text" name="title" placeholder="От 4 до 80 символов" value="{{ old('title') }}" required minlength="4" maxlength="80" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('title'))
                    <p class="mt-2 text-red-600">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-3 text-gray-500">Название <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="От 3 до 24 символов" value="{{ old('name') }}" required minlength="3" maxlength="24" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('name'))
                    <p class="mt-2 text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="cover" class="block mb-3 text-gray-500">Обложка</label>
                <input type="file" name="cover" accept="image/*" class="w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                <label for="price" class="block mb-3 text-gray-500">Стоимость</label>
                <input type="number" name="price" placeholder="От 1 до 100.000 рублей" value="{{ old('price') }}" min="1" max="100000" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('price'))
                    <p class="mt-2 text-red-600">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="file" class="block mb-3 text-gray-500">Файл</label>
                <input type="file" name="file" class="w-full focus:outline-none focus:ring-2 focus:ring-blue-300">
                @if ($errors->has('file'))
                    <p class="mt-2 text-red-600">{{ $errors->first('file') }}</p>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Добавить</button>
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