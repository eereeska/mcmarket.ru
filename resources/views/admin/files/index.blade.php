@extends('layouts.admin')

@section('meta.title', 'Файлы')

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Файлы</h2>
        </div>
        <div id="files" class="section__content list">
            @include('components.files._files', ['files' => $files])
        </div>
    </section>
</div>
<div class="sidebar">
    <section class="section section--sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Фильтры</h2>
            </div>
            <div class="section__content">
                <form action="{{ route('admin.files.index') }}" data-on-submit="request" data-results="#files">
                    @include('components.files.filters._sort')
                    @include('components.files.filters._status')
                    @include('components.files.filters._category')
                    @include('components.files.filters._type')
                    @include('components.files.filters._from')
                </form>
            </div>
        </section>
        @auth
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Меню</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.submit', ['category' => request()->category ?? null]) }}" class="data data_compact">
                    <div class="data__icon icon icon--file-plus"></div>
                    <div class="data__info">
                        <h3 class="data__value">Добавить файл</h3>
                    </div>
                </a>
            </div>
        </section>
        @endauth
    </section>
</div>
@endsection