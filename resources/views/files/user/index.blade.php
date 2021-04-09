@extends('layouts.app')

@section('meta.title', 'Мои файлы')
@section('meta.meta.robots', 'noindex')

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
                </form>
            </div>
        </section>
    </section>
</aside>
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
@endsection