@extends('layouts.app')

@section('content')
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__content">
                <form action="{{ route('home') }}" data-on-submit="request" data-results="#files">
                    @include('components._select', [
                        'label' => 'Сортировка',
                        'name' => 'sort',
                        'submit' => true,
                        'default' => 'update_down',
                        'selected' => request()->get('sort', 'update_down'),
                        'options' => [
                            'update_down' => 'Последнее обновление',
                            'new_down' => 'Новые',
                            'downloads_down' => 'Больше всего скачиваний',
                            'views_down' => 'Больше всего просмотров'
                        ]
                    ])
                    @include('components._select', [
                        'label' => 'Категория',
                        'name' => 'category',
                        'required' => false,
                        'submit' => true,
                        'reset' => true,
                        'compact' => true,
                        'default' => 'Не выбрана',
                        'selected' => request()->get('category', 'none'),
                        'options' => $categories->pluck('title', 'name')->toArray(),
                        'icons' => $categories->pluck('icon', 'name')->toArray()
                    ])
                    @include('components._select', [
                        'label' => 'Тип',
                        'name' => 'type',
                        'submit' => true,
                        'reset' => true,
                        'default' => 'Не выбран',
                        'selected' => request()->get('type', 'none'),
                        'options' => [
                            'free' => 'Бесплатные',
                            'paid' => 'Платные',
                            'nulled' => 'Nulled'
                        ]
                    ])
                    {{-- @include('components.files.filters._from') --}}
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
</aside>
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
@endsection