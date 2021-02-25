@extends('layouts.app')

@section('meta.title', 'Обновление файла ' . $file->name)
@section('meta.robots', 'noindex')

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <ul class="breadcrumb">
                <li class="breadcrumb__item"><a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a></li>
                <li class="breadcrumb__item"><a href="{{ route('file.edit', ['id' => $file->id]) }}">Редактирование</a></li>
                <li class="breadcrumb__item breadcrumb__item--active">Обновление</li>
            </ul>
        </div>
        <div class="section__content">
            <form id="file-update-submit-form" method="post" action="{{ route('file.update.store', ['id' => $file->id]) }}" enctype="multipart/form-data">
                @csrf
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title--required">Новый файл</h2>
                    </div>
                    <div class="section__content">
                        <label class="file">
                            <input type="file" name="file" class="file__original" required>
                            <span class="file__label">Нажмите здесь или перетащите файл</span>
                        </label>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Версия</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="version" placeholder="{{ $file->version ?? '2.0.0' }}" value="{{ $file->version }}" class="input" maxlength="10" autocapitalize="none" autocorrect="off" autocomplete="off">
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Описание</h2>
                    </div>
                    <div class="section__content">
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
                    </div>
                </section>
            </form>
        </div>
    </section>
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        {{-- @if ($file->cover_path)
        <section class="section">
            <a href="{{ route('file.show', ['id' => $file->id]) }}"><img class="cover" src="{{ asset('covers/' . $file->cover_path) }}"></img></a>
        </section>
        @endif --}}
        {{-- <section class="section">
            <div class="section__header">
                <h2 class="section__title">Важно</h2>
            </div>
            <div class="section__content">
                <p>Обратите внимание, что при изменении описания, файл будет повторно отправлен на проверку, но при этом, старая версия файла всё ещё будет доступна пользователям</p>
            </div>
        </section> --}}
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Дополнительно</h2>
            </div>
            <div class="section__content">
                <label class="checkbox classic">
                    <input type="checkbox" name="send_notifications" value="1" checked>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Отправить уведомления, тем, кто следит за обновлениями файла</span>
                </label>
                {{-- <label class="checkbox classic">
                    <input type="checkbox" name="keep_previous_version" value="1" {{ old('keep_previous_version') ? 'checked' : '' }}>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Сохранить предыдущую версию</span>
                </label> --}}
            </div>
        </section>
        <section class="section">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button class="button primary" data-submit="#file-update-submit-form">Опубликовать обновление</button>
        </section>
    </div>
</aside>
@endsection