@extends('layouts.app', [
    'title' => $user->name,
    'page_classes' => 'profile'
])

@section('content')
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        @if ($user->avatar)
        <div class="avatar avatar--large" style="background-image: url({{ $user->avatar }})">{{ $user->getInitials() }}</div>
        @else
        <div class="avatar avatar--large">{{ $user->getInitials() }}</div>
        @endif
        <button class="button primary">Пройти идентификацию</button>
        <section class="section">
            <div class="section__title">Статистика</div>
            <div class="data data_compact">
                <div class="data__icon icon icon--clock"></div>
                <div class="data__info">
                    <p class="data__value" title="{{ $user->created_at->format('h:i:s') }}">{{ $user->created_at->format('d.m.Y') }}</p>
                    <p class="data__desc">Регистрация</p>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--comments"></div>
                <div class="data__info">
                    <p class="data__value">15</p>
                    <p class="data__desc">Сообщений</p>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--download"></div>
                <div class="data__info">
                    <p class="data__value">15</p>
                    <p class="data__desc">Скачиваний</p>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--heart"></div>
                <div class="data__info">
                    <p class="data__value">15</p>
                    <p class="data__desc">Реакций оставлено</p>
                </div>
            </div>
        </section>
    </div>
</aside>
<div class="content">
    <h1 class="name">{{ $user->name }}</h1>
</div>
@endsection