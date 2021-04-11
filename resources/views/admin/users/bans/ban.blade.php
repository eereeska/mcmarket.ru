@extends('layouts.admin')

@section('meta.title', 'Блокировка пользователя ' . $user->name)

@section('content')
<div class="content">
    <form id="user-ban-form" action="{{ url()->current() }}" method="post">
        @csrf
        @include('components._select', [
            'label' => 'Пользователь',
            'required' => true,
            'name' => 'user',
            'submit' => false,
            'default' => 'Не выбран',
            'selected' => request()->get('user', 'none'),
            'search' => [
                'url' => route('search.users')
            ]
        ])
        <section class="section section_compact">
            <div class="section__header">
                <label for="reason" class="section__title">Причина</label>
            </div>
            <div class="section__content">
                <textarea name="reason" class="textarea textarea_small" placeholder="Плохое поведение"></textarea>
            </div>
        </section>
        <section class="section">
            <div class="section__content">
                <button class="button primary" type="submit">Заблокировать</button>
            </div>
        </section>
    </form>
</div>
@endsection