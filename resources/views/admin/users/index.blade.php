@extends('layouts.admin')

@section('meta.title', 'Файлы')

@section('content')
<div class="content">
    <div id="users" class="section__content list">
        @include('components.admin.users._users')
    </div>
</div>
<div class="sidebar">
    <section class="section section_sticky">
        <form action="{{ route('admin.users.index') }}" method="post" data-on-submit="request" data-results="#users" data-timeout="400">
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Поиск</h2>
                </div>
                <div class="section__content">
                    <input type="text" name="search" placeholder="Поиск..." value="{{ old('search') }}" class="input" autocomplete="off" autofocus data-on-change="submit">
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Фильтры</h2>
                </div>
                <div class="section__content">
                    @include('components._select', [
                        'label' => 'Сортировка',
                        'name' => 'sort',
                        'submit' => true,
                        'default' => 'created_at-desc',
                        'selected' => request()->get('sort', 'created_at-desc'),
                        'options' => [
                            'created_at-desc' => 'Сначала новые',
                            'created_at-asc' => 'Сначала старые',
                            'az' => 'По алфавиту от А до Я',
                            'za' => 'По алфавиту от Я до А',
                            'balance-desc' => 'Сначала богатые',
                            'balance-asc' => 'Сначала бедные',
                            'followers' => 'Больше всего подписчиков'
                        ]
                    ])
                </div>
            </section>
        </form>
    </section>
</div>
@endsection