@extends('layouts.app')

@section('meta.title', $user->name)

@if (!$user->settings->is_search_engine_visible)
@section('meta.robots', 'noindex')
@endif

@section('content')
<div class="flex flex-wrap gap-x-10 gap-y-6 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <aside class="w-full lg:w-1/3">
        <section class="mb-8">
            <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}" class="rounded-md">
        </section>
        @if (auth()->id() == $user->id)
        <section class="mb-8">
            <a href="{{ route('settings') }}" class="block rounded-md mt-3 px-3 py-2 font-semibold text-center transition hover:bg-blue-100 hover:text-blue-500 focus:outline-none focus:bg-blue-100">Настройки</a>
        </section>
        @endif
        <section class="space-y-3 mb-6">
            <h2 class="mb-4 text-gray-500">Информация</h2>
            <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                    <i class="far fa-clock"></i>
                </div>
                <div class="flex-grow">
                    <time datetime="{{ $user->created_at->toAtomString() }}" title="{{ $user->created_at->format('d.m.Y h:i:s') }}" class="font-semibold">{{ $user->created_at->ago() }}</time>
                    <div class="text-sm text-gray-500">Регистрация</div>
                </div>
            </div>
        </section>
    </aside>
    <main class="w-full">
        <h1 class="font-bold text-xl">{{ $user->name }}</h1>
        @if ($user->settings->about)
            <section class="mt-4">
                <h2 class="mb-2 font-semibold">Обо мне</h2>
                <p>{!! nl2br($user->settings->about) !!}</p>
            </section>
        @endif
    </main>
</div>
{{-- <aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
        @include('components._avatar', ['user' => $user, 'large' => true])
        </section>
        @if (auth()->id() == $user->id)
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
    <section class="section section_compact">
        @include('user._name', ['user' => $user])
        <p>{{ $user->role->title }}, {{ $user->settings->is_online_status_visible ?  $user->getOnlineStatus() : 'Оффлайн' }}</p>
    </section>
    <section class="section">
        <div class="data data_compact">
            <div class="data__icon icon icon_heart"></div>
            <div class="data__info">
                <h3 class="data__value"><a href="#">My Club</a></h3>
                <span class="data__desc">Владелец сообщества</span>
            </div>
        </div>
    </section>
    @if (!is_null($user->settings->about))
    <section class="section">
        <h2 class="section__title">Обо мне</h2>
        <p>{!! $user->settings->about !!}</p>
    </section>
    @endif
    <section class="section">
        <div class="section__content buttons buttons_inline buttons_inline_fluid">
            @if (auth()->id() == $user->id)
            @if (!Auth::user()->verified)
            <button class="button primary">Пройти идентификацию</button>
            @endif
            <a href="{{ route('settings') }}" class="button">Настройки</a>
            @elseif (Auth::check())
            <a href="{{ route('chat', ['chat' => $chat]) }}" class="button primary">Написать</a>
            <button class="button primary" data-action="request" data-url="{{ route('user.follow', ['user' => $user]) }}">Подписаться</button>
            @endif
        </div>
    </section>
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
</div> --}}
@endsection