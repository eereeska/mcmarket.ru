@extends('layouts.app')

@section('meta.title', 'Редактирование файла ' . $file->name)

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
            <li class="text-gray-500">Редактирование</li>
        </ol>
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="mb-6">
                <label for="category" class="block mb-3 text-gray-500">Категория <span class="text-red-500">*</span></label>
                <select name="category" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left cursor-default focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option disabled selected value>Не указана</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" @if ($category->name == $file->category->name) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <p class="mt-2 text-red-600">{{ $errors->first('category') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="title" class="block mb-3 text-gray-500">Заголовок <span class="text-red-500">*</span></label>
                <input type="text" name="title" placeholder="От 4 до 60 символов" value="{{ $file->title }}" required minlength="4" maxlength="60" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('title'))
                    <p class="mt-2 text-red-600">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-3 text-gray-500">Название <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="От 3 до 24 символов" value="{{ $file->name }}" required minlength="3" maxlength="24" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('name'))
                    <p class="mt-2 text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div id="cover" class="mb-6">
                <label for="cover" class="block mb-3 text-gray-500">Обложка <span class="text-red-500">*</span></label>
                <input type="file" name="cover" accept="image/*" value="{{ $file->cover_path }}" class="w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($errors->has('cover'))
                    <p class="mt-2 text-red-600">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <div id="description" class="mb-6">
                <label for="description" class="block mb-3 text-gray-500">Описание <span class="text-red-500">*</span></label>
                <div contenteditable="true" spellcheck="true" data-name="description" class="bg-white border rounded-md px-3 py-2 space-y-3 focus:outline-none focus:ring-2 focus:border-blue-500">{!! $file->description ?? '<p>Самое скучное описание...</p>' !!}</div>
                @if ($errors->has('description'))
                    <p class="mt-2 text-red-600">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="price" class="block mb-3 text-gray-500">Стоимость</label>
                <input type="number" name="price" placeholder="От 1 до 100.000 рублей" value="{{ $file->price }}" min="1" max="100000" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('price'))
                    <p class="mt-2 text-red-600">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="version" class="block mb-3 text-gray-500">Версия</label>
                <input type="text" name="version" placeholder="От 1 до 6 символов" value="{{ $file->version }}" minlength="1" maxlength="6" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('version'))
                    <p class="mt-2 text-red-600">{{ $errors->first('version') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="keywords" class="block mb-3 text-gray-500">Ключевые слова</label>
                <input type="text" name="keywords" placeholder="От 2 до 200 символов" value="{{ $file->keywords }}" minlength="2" maxlength="200" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('keywords'))
                    <p class="mt-2 text-red-600">{{ $errors->first('keywords') }}</p>
                @endif
            </div>
        </form>
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="sticky top-6">
            <div class="mb-6">
                @include('files.components._cover')
            </div>
            <div class="mb-6">
                <button type="submit" class="sticky bottom-3 w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Сохранить</button>
            </div>
            <div class="rounded-md border-b-2 border-gray-200 mt-6 mb-6"></div>
            <a href="{{ route('file.update.submit', ['id' => $file->id]) }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 mb-4 font-semibold hover:text-blue-500">
                <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                    <i class="far fa-upload"></i>
                </div>
                <span>Добавить обновление</span>
            </a>
            <a href="{{ route('file.update.submit', ['id' => $file->id]) }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                    <div class="far fa-trash"></div>
                </div>
                <span>Удалить файл</span>
            </a>
        </div>
    </aside>
</div>
{{-- <div class="content">
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Описание</h2>
                    </div>
                    <div class="section__content">
                        <div class="editor">
                            <div class="editor__toolbar" data-sticky>
                                <button data-command="bold"></button>
                                <button data-command="italic"></button>
                                <button data-command="strikethrough"></button>
                                <button data-command="underline"></button>
                                <button data-command="removeFormat"></button>
                                <button data-command="insertOrderedList"></button>
                                <button data-command="insertUnorderedList"></button>
                                <button data-command="justifyLeft"></button>
                                <button data-command="justifyCenter"></button>
                                <button data-command="justifyRight"></button>
                            </div>
                            <div class="editor__content" data-name="description" placeholder="Описание" dir="auto" contenteditable="true" spellcheck="true" required>{!! $file->description !!}</div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Ключевые слова</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="keywords" placeholder="Мой первый плагин, Бесплатно" value="{{ $file->keywords }}" class="input" autocomplete="off">
                    </div>
                </section>
            </form>
        </div>
    </section>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.edit', ['id' => $file->id]) }}" class="data data_compact" data-submit="#file-edit-form">
                    <div class="data__icon icon icon_save"></div>
                    <div class="data__info">
                        <h3 class="data__value">Сохранить</h3>
                    </div>
                </a>
                <a href="{{ route('file.update.submit', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon_upload"></div>
                    <div class="data__info">
                        <h3 class="data__value">Добавить обновление</h3>
                    </div>
                </a>
                @foreach ($errors->all() as $error)
                <p class="alert red small">{{ $error }}</p>
                @endforeach
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Опасная зона</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.delete', ['id' => $file->id]) }}" data-request="delete" data-confirm="Вы уверены, что хотите удалить «{{ $file->name }}»" class="data data_compact">
                    <div class="data__icon icon icon_trash-alt"></div>
                    <div class="data__info">
                        <h3 class="data__value">Удалить файл</h3>
                    </div>
                </a>
            </div>
        </section>
    </div>
</aside> --}}
@endsection