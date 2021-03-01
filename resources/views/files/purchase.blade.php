@extends('layouts.app')

@section('meta.title', 'Покупка ' . $file->name)
@section('meta.description', 'Покупка «' . $file->title . '»')

@if ($file->keywords)
@section('meta.keywords', $file->keywords)
@endif

@if ($file->cover_path)
@section('meta.og:image', asset('covers/' . $file->cover_path))
@endif

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <h1 class="section__title">Приобритение «{{ $file->name }}»</h1>
            @if ($file->version)
            <span class="muted">{{ $file->version }}</span>
            @endif
        </div>
        <div class="section__content">
            <p>Обратите внимание, что администрация сайта не несёт ответственность за файлы, размещённые участниками сообщества, но вы можете разместить новый запрос в арбитраж, если приобретённый файл не будет соответствует описанию.</p>
        </div>
    </section>
    {{-- <section class="section">
        <div class="section__header">
            <h2 class="section__title">Комментарий продавца</h2>
        </div>
        <div class="section__content">
            <ul>
                <li>Запрещено сливать</li>
                <li>Запрещено перепродавать</li>
                <li>Запрещено размещать где угодно</li>
            </ul>
        </div>
    </section> --}}
</div>
<aside class="sidebar">
    <section class="section">
        @if ($file->cover_path)
        <img class="cover" src="{{ asset('covers/' . $file->cover_path) }}" alt="{{ $file->title }}"></img>
        @endif
    </section>
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.purchase', ['id' => $file->id]) }}" data-request="post" class="data data_compact">
                    <div class="data__icon icon icon_cart"></div>
                    <div class="data__info">
                        <h3 class="data__value">Купить</h3>
                    </div>
                </a>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                @if ($file->type === 'free')
                <h2 class="section__title">Автор</h2>
                @elseif ($file->type === 'paid')
                <h2 class="section__title">Продавец</h2>
                @elseif ($file->type === 'nulled')
                <h2 class="section__title">Поделился</h2>
                @endif
            </div>
            <div class="section__content">
                <a href="{{ route('user.show', ['user' => $file->user]) }}" class="data">
                    <div class="data__icon avatar" style="background-image: url({{ $file->user->getAvatar() }});"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->user->name }}</h3>
                    </div>
                </a>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Информация</h2>
            </div>
            <div class="section__content">
                @include('components.files.sidebar._info', ['file' => $file])
            </div>
        </section>
    </section>
</aside>
@endsection