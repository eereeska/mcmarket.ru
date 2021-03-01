@extends('layouts.app')

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
                <a href="{{ route('files.my') }}" class="data data_compact">
                    <div class="data__icon icon icon_file"></div>
                    <div class="data__info">
                        <h3 class="data__value">Мои файлы</h3>
                    </div>
                </a>
            </div>
        </section>
        @endauth
    </section>
</div>
@endsection