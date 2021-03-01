@extends('layouts.app', [
    'page_classes' => 'file',
    'title' => 'Обновление версии файла ' . $file->short_title
])

@section('content')
<div class="content">
    <form id="file-update-form" method="post" action="{{ route('file-update', ['file' => $file]) }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Файл</h2>
            </div>
            <div class="section__content">
                <label class="file">
                    <input type="file" name="file" class="file__original">
                    <span class="file__label">Нажмите здесь или перетащите файл</span>
                </label>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Новая версия</h2>
            </div>
            <div class="section__content">
                <input type="text" name="version" placeholder="{{ $file->version }}" autocorrect="off" autocomplete="off">
            </div>
        </section>
    </form>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        @if ($file->cover_path)
        <section class="section">
            <img class="cover" src="{{ asset('covers/' . $file->cover_path) }}"></img>
        </section>
        @endif
        <section class="section">
            <button data-action="form-submit" data-target="#file-update-form" class="button primary">Добавить обновление</button>
        </section>
    </div>
</aside>
@endsection