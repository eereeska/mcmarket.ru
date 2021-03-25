@extends('layouts.app')

@section('meta.title', $user->name)

@if (!$user->settings->is_search_engine_visible)
@section('meta.robots', 'noindex')
@endif

@section('content')
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                @include('components._avatar', ['user' => $user, 'large' => true])
            </div>
            <div class="section__content buttons">
                @if (Auth::check() and Auth::user()->id == $user->id)
                @if (!Auth::user()->verified)
                <button class="button primary">Пройти идентификацию</button>
                @endif
                <a href="{{ route('settings') }}" class="button">Настройки</a>
                @elseif (Auth::check())
                {{-- <a href="{{ route('chat', ['chat' => $chat]) }}" class="button primary">Написать</a> --}}
                <button class="button primary" data-action="request" data-url="{{ route('user.follow', ['name' => $user->name]) }}">Подписаться</button>
                @endif
            </div>
        </section>
        @if (Auth::check() and Auth::user()->id == $user->id)
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Информация</h2>
            </div>
            <div class="section__content">
                <div class="data data_compact">
                    @if ($user->balance > 1000)
                    <div class="data__icon icon icon_coins"></div>
                    @else
                    <div class="data__icon icon icon_coin"></div>
                    @endif
                    <div class="data__info">
                        <span class="data__value">{{ $user->balance }} @choice('рубль|рубля|рублей', $user->balance)</span>
                        <span class="data__desc">Баланс</span>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon_clock"></div>
                    <div class="data__info">
                        <span class="data__value" title="{{ $user->created_at->format('d.m.Y h:i:s') }}">{{ $user->created_at->ago() }}</span>
                        <span class="data__desc">Регистрация</span>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if ($user->followers_count > 0)
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Подписчики <span class="muted">{{ $user->followers_count }}</span></h2>
            </div>
            <div class="section__content">
                @foreach ($user->followers as $follower)
                <div class="data data_compact">
                    @include('components._avatar', ['user' => $follower])
                    <div class="data__info">
                        <span class="data__value"><a href="{{ route('user.show', ['name' => $follower->name]) }}">{{ $follower->name }}</a></span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Статистика</h2>
            </div>
            <div class="section__content">
                <div class="data data_compact">
                    <div class="data__icon icon icon_comments"></div>
                    <div class="data__info">
                        <span class="data__value">15</span>
                        <span class="data__desc">Сообщений</span>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon_download"></div>
                    <div class="data__info">
                        <span class="data__value">15</span>
                        <span class="data__desc">Скачиваний</span>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon_heart"></div>
                    <div class="data__info">
                        <span class="data__value">15</span>
                        <span class="data__desc">Реакций оставлено</span>
                    </div>
                </div>
            </div>
        </section>
    </section>
</aside>
<div class="content">
    <section class="section compact">
        @include('user._name', ['user' => $user])
        <p>{{ $user->role->title }}, {{ $user->settings->is_online_status_visible ?  $user->getOnlineStatus() : 'Оффлайн' }}</p>
    </section>
    {{-- <section class="section">
        <div class="data data_compact">
            <div class="data__icon icon icon_heart"></div>
            <div class="data__info">
                <h3 class="data__value"><a href="#">My Club</a></h3>
                <span class="data__desc">Владелец сообщества</span>
            </div>
        </div>
    </section> --}}
    @if (!is_null($user->settings->about))
    <section class="section">
        <h2 class="section__title">Обо мне</h2>
        <p>{!! $user->settings->about !!}</p>
    </section>
    @endif
    <section class="section">
        <div class="tabs">
            <a href="#files" class="tabs__tab tabs__tab_active">Файлы</a>
            <a href="#goods" class="tabs__tab">Товары</a>
        </div>
        <div class="tabs__content">
            <div id="files" class="list active-tab">
                @include('components.files._files', ['files' => $user->files])
            </div>
            <div id="goods" class="list">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, nam officia sapiente officiis tenetur quae numquam voluptatum suscipit vitae odit excepturi impedit reprehenderit cum totam at incidunt fuga doloremque illo rerum earum. Nobis pariatur repudiandae ipsum optio fuga sequi minus laborum atque aliquid ducimus facere neque soluta odit culpa molestiae harum ipsam eligendi veniam, dicta dolorum nostrum architecto? Officiis ducimus doloribus ea quis dolorum, nulla repellat libero animi doloremque voluptates ipsam dolorem, ex, iusto rerum accusantium? Ea ducimus minus ipsa numquam distinctio facilis commodi voluptate iure, corrupti laudantium dolores quis atque magni natus eius eum excepturi ipsam maiores consequatur perspiciatis!</div>
        </div>
    </section>
</div>
@endsection