@extends('layouts.app')

@section('meta.title', 'Мои файлы')
@section('meta.meta.robots', 'noindex')

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Мои файлы</h2>
        </div>
        <div id="files" class="section__content list">
            @include('components.files._files', ['files' => $files])
        </div>
    </section>
</div>
<div class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Фильтры</h2>
            </div>
            <div class="section__content">
                <form action="{{ route('home') }}" data-on-submit="request" data-results="#files">
                    @include('components.files.filters._sort')
                    @include('components.files.filters._category')
                    @include('components.files.filters._type')
                </form>
            </div>
        </section>
        {{-- @auth
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Меню</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.submit', ['category' => request()->category ?? null]) }}" class="data data_compact">
                    <div class="data__icon icon icon_file-plus"></div>
                    <div class="data__info">
                        <h3 class="data__value">Добавить файл</h3>
                    </div>
                </a>
            </div>
        </section>
        @endauth --}}
    </section>
</div>
@endsection