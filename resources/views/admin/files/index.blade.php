@extends('layouts.admin')

@section('meta.title', 'Файлы')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <aside class="w-full lg:w-1/3">
        <div class="mb-6">
            <label for="sort" class="block mb-3 text-gray-500">Сортировка</label>
            <select name="sort" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left cursor-default focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="updated">Последние обновления</option>
                <option value="new">Сначала новые</option>
                <option value="downloads">Самые скачиваемые</option>
                <option value="views">Самые просматриваемые</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="sort" class="block mb-3 text-gray-500">Категория</label>
            <select name="sort" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left cursor-default focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <a href="{{ route('file.submit') }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                    <i class="far fa-file-plus"></i>
                </div>
                <span>Добавить файл</span>
            </a>
        </div>
    </aside>
    <main class="w-full space-y-4">
        @each('admin.files.components._preview', $files, 'file', 'components._empty')
        {{ $files->links() }}
    </main>
</div>
{{-- <aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Фильтры</h2>
            </div>
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
</div> --}}
@endsection