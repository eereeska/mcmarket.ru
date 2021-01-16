@extends('layouts.app', [
    'title' => $user->name,
    'page_classes' => 'profile'
])

@if (!$user->settings->is_search_engine_visible)
@section('meta.robots')
<meta name="robots" content="noindex" />
@endsection
@endif

@section('content')
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        <section class="section">
            @include('components._avatar', ['user' => $user, 'large' => true])
            @if (Auth::user()->id == $user->id)
            @if (!Auth::user()->verified)
            <button class="button primary">Пройти идентификацию</button>
            @endif
            <a href="{{ route('settings') }}" class="button">Настройки</a>
            @endif
        </section>
        <section class="section">
            <h2 class="section__title">Статистика</h2>
            <div class="data data_compact">
                <div class="data__icon icon icon--clock"></div>
                <div class="data__info">
                    <span class="data__value" title="{{ $user->created_at->format('h:i:s') }}">{{ $user->created_at->format('d.m.Y') }}</span>
                    <span class="data__desc">Регистрация</span>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--comments"></div>
                <div class="data__info">
                    <span class="data__value">15</span>
                    <span class="data__desc">Сообщений</span>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--download"></div>
                <div class="data__info">
                    <span class="data__value">15</span>
                    <span class="data__desc">Скачиваний</span>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--heart"></div>
                <div class="data__info">
                    <span class="data__value">15</span>
                    <span class="data__desc">Реакций оставлено</span>
                </div>
            </div>
        </section>
    </div>
</aside>
<div class="content">
    <section class="section compact">
        @include('user._name', ['user' => $user])
        <p>{{ $user->role_id == 1 ? 'Администратор' : 'Участник' }}{{ $user->settings->is_online_status_visible ?  $user->isOnline() ? ', online' : ', offline' : '' }}</p>
    </section>
    <section class="section">
        <div class="data data_compact">
            <div class="data__icon icon icon--heart"></div>
            <div class="data__info">
                <h3 class="data__value"><a href="#">My Club</a></h3>
                <span class="data__desc">Владелец сообщества</span>
            </div>
        </div>
    </section>
    @if (!is_null($user->settings->about))
    <section class="section">
        <h2 class="section__title">Обо мне</h2>
        <p>{!! nl2br($user->settings->about) !!}</p>
    </section>
    @endif
    <section class="section">
        <div class="tabs">
            <a href="#activity" class="tabs__tab active">Активность</a>
            <a href="#files" class="tabs__tab">Файлы</a>
            <a href="#goods" class="tabs__tab">Товары</a>
        </div>
        <div class="tabs__content">
            <div id="activity" class="list active-tab">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat quos ab autem atque similique dicta dignissimos? Velit corrupti quisquam, ipsa dolores ut eveniet rerum error consectetur, delectus odio, culpa obcaecati.
            </div>
            <div id="files" class="list">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique fugiat rem, ut distinctio quos sapiente inventore vitae, suscipit quasi temporibus ex est! Quis accusamus eum incidunt nam ipsa laudantium ratione. Ipsa blanditiis consequatur fugit veniam veritatis possimus repellat nesciunt a iure repellendus temporibus, earum est laboriosam facere esse delectus hic.</div>
            <div id="goods" class="list">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, nam officia sapiente officiis tenetur quae numquam voluptatum suscipit vitae odit excepturi impedit reprehenderit cum totam at incidunt fuga doloremque illo rerum earum. Nobis pariatur repudiandae ipsum optio fuga sequi minus laborum atque aliquid ducimus facere neque soluta odit culpa molestiae harum ipsam eligendi veniam, dicta dolorum nostrum architecto? Officiis ducimus doloribus ea quis dolorum, nulla repellat libero animi doloremque voluptates ipsam dolorem, ex, iusto rerum accusantium? Ea ducimus minus ipsa numquam distinctio facilis commodi voluptate iure, corrupti laudantium dolores quis atque magni natus eius eum excepturi ipsam maiores consequatur perspiciatis!</div>
        </div>
    </section>
</div>
@endsection