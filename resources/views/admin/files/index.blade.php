@extends('layouts.admin')

@section('meta.title', 'Файлы')

@section('content')
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            {{-- <div class="section__header">
                <h2 class="section__title">Фильтры</h2>
            </div> --}}
            <div class="section__content">
                <form action="{{ route('admin.files.index') }}" data-on-submit="request" data-results="#files">
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
                    @include('components._select', [
                        'label' => 'Статус',
                        'name' => 'status',
                        'submit' => true,
                        'reset' => true,
                        'default' => 'Не выбран',
                        'selected' => request()->get('status'),
                        'options' => [
                            'hidden' => 'Скрыт',
                            'pending' => 'На рассмотрении',
                            'approved' => 'Одобрен'
                        ]
                    ])
                    @include('components._select', [
                        'label' => 'От пользователя',
                        'name' => 'from',
                        'submit' => true,
                        'default' => 'Не указан',
                        'selected' => 'none',
                        'search' => [
                            'url' => route('search.users')
                        ]
                    ])
                </form>
            </div>
        </section>
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
    </section>
</aside>
<div class="content">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Файлы</h2>
        </div>
        <div id="files" class="section__content list">
            @include('components.admin.files._files', ['files' => $files])
        </div>
    </section>
</div>
@endsection