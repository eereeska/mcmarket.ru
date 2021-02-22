@extends('layouts.app')

@section('meta.title', $file->getTabTitle())

@if ($file->description)
@section('meta.description', substr(strip_tags($file->description), 0, 150))
@endif

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
            <ul class="breadcrumb">
                <li class="breadcrumb__item"><a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a></li>
                @if ($file->is_visible)
                <li class="breadcrumb__item breadcrumb__item--active"><h1>{{ $file->name }}</h1></li>
                @else
                <li class="breadcrumb__item breadcrumb__item--active"><h1>{{ $file->name }} <span class="muted">(скрыт)</span></h1></li>
                @endif
            </ul>
            @if ($file->version)
            <span class="muted">{{ $file->version }}</span>
            @endif
        </div>
        <div class="section__content">
            @if ($file->description)
            <article class="article">
                {!! $file->description !!}
            </article>
            @else
            <p class="alert red">Заполните описание</p>
            @endif
        </div>
    </section>
</div>
<aside class="sidebar">
    <section class="section">
        @if ($file->cover_path)
        <img class="cover" src="{{ asset('covers/' . $file->cover_path) }}" alt="{{ $file->title }}"></img>
        @else
        <p class="alert red">Добавьте обложку</p>
        @endif
    </section>
    <section class="section section--sticky">
        @if (auth()->check())
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                @if (auth()->user()->id != $file->user_id and !auth()->user()->hasPurchasedFile($file))
                <a href="{{ route('file.purchase', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon--cart"></div>
                    <div class="data__info">
                        <h3 class="data__value">Купить</h3>
                    </div>
                </a>
                @else
                <a href="{{ route('file.download', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon--download"></div>
                    <div class="data__info">
                        <h3 class="data__value">Скачать</h3>
                    </div>
                </a>
                @endif
                @if ($file->user_id == auth()->user()->id)
                <a href="{{ route('file.edit', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon--edit"></div>
                    <div class="data__info">
                        <h3 class="data__value">Редактировать</h3>
                    </div>
                </a>
                @else
                <a href="#" class="data data_compact">
                    <div class="data__icon icon icon--report"></div>
                    <div class="data__info">
                        <h3 class="data__value">Пожаловаться</h3>
                    </div>
                </a>
                @endif
            </div>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                @if ($file->type === 'paid')
                <h2 class="section__title">Продавец</h2>
                @else
                <h2 class="section__title">Автор</h2>
                @endif
            </div>
            <div class="section__content">
                <a href="{{ route('user.show', ['user' => $file->user]) }}" class="data">
                    <div class="data__icon avatar" style="background-image: url({{ $file->user->getAvatar() }})"></div>
                    <div class="data__info">
                        <h3 class="data__value sidebar_trim_with_icon">{{ $file->user->name }}</h3>
                    </div>
                </a>
            </div>
        </section>
        @if ($file->donation_url)
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Ссылки</h2>
            </div>
            <div class="section__content">
                <a href="{{ $file->donation_url }}" class="data data_compact">
                    <div class="data__icon icon icon--coin"></div>
                    <div class="data__info">
                        <h3 class="data__value">Поддержать автора</h3>
                    </div>
                </a>
            </div>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Информация</h2>
            </div>
            <div class="section__content">
                @include('components.files.sidebar._info', ['file' => $file])
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Статистика</h2>
            </div>
            <div class="section__content">
                <div class="data data_compact">
                    <div class="data__icon icon icon--eye"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ number_format($file->views_count, 0, ' ', ' ') }}</h3>
                        <div class="data__desc">@choice('Просмотр|Просмотра|Просмотров', $file->views_count)</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon--download"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ number_format($file->downloads_count, 0, ' ', ' ') }}</h3>
                        <div class="data__desc">@choice('Скачивание|Скачивания|Скачиваний', $file->downloads_count)</div>
                    </div>
                </div>
                @if ($file->type == 'paid')
                <div class="data data_compact">
                    <div class="data__icon icon icon--cart"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->purchases_count }}</h3>
                        <div class="data__desc">@choice('Покупка|Покупки|Покупок', $file->purchases_count)</div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </section>
</aside>
@endsection