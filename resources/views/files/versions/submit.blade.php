@extends('layouts.app')

@section('meta.title', 'Обновление файла ' . $file->short_title)
@section('meta.robots', 'noindex')

@section('content')
<div class="content">
    <form id="file-version-submit-form" method="post" action="{{ route('file.version.submit', ['file' => $file]) }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Файл</h2>
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
                <input type="text" name="version" placeholder="{{ $file->version ?? '2.0.0' }}" value="{{ $file->version }}" maxlength="10" autocapitalize="none" autocorrect="off" autocomplete="off">
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Что нового?</h2>
            </div>
            <div class="section__content">
                <textarea name="description" placeholder="Была улучшена производительность и исправлены ошибки..."></textarea>
                {{-- <div class="editor">
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
                    <div class="editor__content" placeholder="Содержание" dir="left" contenteditable="true" spellcheck="true" data-name="description" data-required="true"></div>
                </div> --}}
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
                <h2 class="section__title">Важно</h2>
            </div>
            <div class="section__content">
                <p>Обратите внимание, что мы храним не более 10 последних обновлений</p>
            </div>
        </section>
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
                <label class="checkbox classic">
                    <input type="checkbox" name="keep_previous_version" value="1" {{ old('keep_previous_version') ? 'checked' : '' }}>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Сохранить предыдущую версию</span>
                </label>
            </div>
        </section>
        <section class="section">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button data-action="form-submit" data-target="#file-version-submit-form" class="button primary">Опубликовать обновление</button>
        </section>
    </div>
</aside>
@endsection