@extends('layouts.app', [
    'page_classes' => 'file',
    'title' => 'Редактирование файла ' . $file->short_title
])

@section('content')
<div class="content">
    <form id="file-edit-form" method="post" action="{{ route('file.edit', ['file' => $file]) }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Категория</h2>
            </div>
            <div class="section__content">
                @foreach ($categories as $category)
                <label class="radio">
                    <input type="radio" name="category" value="{{ $category->name }}" class="radio__original" {{ $file->category->name == $category->name ? 'checked="checked"' : '' }}>
                    <span class="radio__mark"></span>
                    <span class="radio__label">{{ $category->title }}</span>
                </label>
                @endforeach
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Заголовок</h2>
            </div>
            <div class="section__content">
                <input type="text" name="title" placeholder="Отображается в заголовке страницы и в поиске" value="{{ $file->title }}" maxlength="60" autocapitalize="none" autocorrect="off" autocomplete="off" required>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Короткий заголовок (название)</h2>
            </div>
            <div class="section__content">
                <input type="text" name="short_title" placeholder="Отображается на главной странице, в названии файла" value="{{ $file->short_title }}" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="off" required>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <div class="section__header-left">
                    <h2 class="section__title section__title--required">Тип</h2>
                </div>
            </div>
            <div class="section__content">
                <label class="radio">
                    <input type="radio" name="type" value="free" class="radio__original" {{ $file->type == 'free' ? 'checked="checked"' : '' }}>
                    <span class="radio__mark"></span>
                    <span class="radio__label">Бесплатный</span>
                </label>
                <label class="radio">
                    <input type="radio" name="type" value="nulled" class="radio__original" {{ $file->type == 'nulled' ? 'checked="checked"' : '' }}>
                    <span class="radio__mark"></span>
                    <span class="radio__label">Nulled</span>
                </label>
                <label class="radio">
                    <input type="radio" name="type" value="paid" class="radio__original" {{ $file->type == 'paid' ? 'checked="checked"' : '' }}>
                    <span class="radio__mark"></span>
                    <span class="radio__label">Платный</span>
                </label>
                <div class="hidden {{ $file->type == 'paid' ? 'hidden--visible"' : '' }}" data-show-if="radio-checked" data-target-name="type" data-target-value="paid">
                    <input type="number" name="price" placeholder="Введите стоимость в рублях..." value="{{ old('price') }}" min="1" autocorrect="off" autocomplete="off">
                    <p>Обратите внимание, что комиссия сервиса составляет <span>{{ config('mcm.fee') }}%</span></p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Обложка</h2>
            </div>
            <div class="section__content">
                <label class="file">
                    <input type="file" name="cover" accept="image/*" value="{{ $file->cover_path }}" class="file__original">
                    <span class="file__label">Нажмите здесь или перетащите изображение</span>
                </label>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Описание</h2>
            </div>
            <div class="section__content">
                <textarea name="description" placeholder="Описание">{{ strip_tags($file->description) }}</textarea>
            </div>
            {{-- <div class="section__content">
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
                        <button data-command="superscript"></button>
                        <button data-command="subscript"></button>
                    </div>
                    <div class="editor__content" name="body" placeholder="Описание" dir="auto" contenteditable="true" spellcheck="true" required>{!! $file->description !!}</div>
                </div>
            </div> --}}
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Медиа</h2>
            </div>
            <div class="section__content">
                @if ($file->media_count > 0)
                @include('components.files._media', ['media' => $file->media])
                @endif
                <label class="file">
                    <input type="file" name="media-images[]" multiple accept="image/*" class="file__original" data-auto-upload="{{ route('file.media', ['file' => $file]) }}">
                    <span class="file__label">Нажмите здесь или перетащите изображения для загрузки</span>
                </label>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Версия</h2>
            </div>
            <div class="section__content">
                <input type="text" name="version" value="{{ $file->version }}" placeholder="1.0.0" autocorrect="off" autocomplete="off">
            </div>
        </section>
        {{-- <section class="section">
            <div class="section__header">
                <h2 class="section__title">Собственная ссылка</h2>
            </div>
            <div class="section__content">
                <input type="text" name="custom_url" value="{{ $file->slug }}" placeholder="my-custom-url" autocorrect="off" autocomplete="off">
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Ссылка для пожертвований</h2>
            </div>
            <div class="section__content">
                <input type="text" name="donation_url" value="{{ $file->donation_url }}" placeholder="paypal.me/mcmarket" autocorrect="off" autocomplete="off">
            </div> --}}
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Название скачиваемого файла</h2>
            </div>
            <div class="section__content">
                <input type="text" name="name" value="{{ $file->name }}" placeholder="{{ $file->version ? $file->short_title . ' ' . $file->version : $file->short_title }}" autocomplete="no">
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Ключевые слова</h2>
            </div>
            <div class="section__content">
                <input type="text" name="keywords" value="{{ $file->keywords }}" placeholder="Мой первый плагин, Бесплатно" autocomplete="off">
            </div>
        </section>
    </form>
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        @if ($file->cover_path)
        <section class="section">
            <a href="{{ route('file-show', ['file' => $file]) }}"><img class="cover" src="{{ asset('covers/' . $file->cover_path) }}"></img></a>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.edit', ['file' => $file]) }}" class="data data_compact" data-action="form-submit" data-target="#file-edit-form">
                    <div class="data__icon icon icon--save"></div>
                    <div class="data__info">
                        <h3 class="data__value">Сохранить</h3>
                    </div>
                </a>
                <a href="{{ route('file.version.submit', ['file' => $file]) }}" class="data data_compact">
                    <div class="data__icon icon icon--upload"></div>
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
                <a href="{{ route('file.delete', ['file' => $file]) }}" data-action="request" data-method="post" data-confirm="Вы уверены, что хотите удалить «{{ $file->short_title }}»" class="data data_compact">
                    <div class="data__icon icon icon--trash-alt"></div>
                    <div class="data__info">
                        <h3 class="data__value">Удалить файл</h3>
                    </div>
                </a>
            </div>
        </section>
    </div>
</aside>
@endsection