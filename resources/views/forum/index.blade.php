@extends('layouts.app')

@section('content')
<div class="content">
    <section class="section">
        <div class="section__title">Теги</div>
        <div class="tags">
            @include('components.tags', ['tags' => $tags])
        </div>
    </section>
    <section class="section">
        <div class="section__title">
            <div class="dropdown">
                <button class="dropdown__title">Новые сообщения</button>
                <ul class="dropdown__content">
                    <li class="dropdown__item"><a href="#">Новые темы</a></li>
                    <li class="dropdown__item"><a href="#">Самые просматриваемые</a></li>
                    <li class="dropdown__item"><a href="#">Самые обсуждаемые</a></li>
                </ul>
            </div>
        </div>
        <div class="forum__threads">
            @foreach ($threads as $thread)
            <div class="forum__thread">
                <div class="avatar" @if ($thread->author->avatar) style="background-image: url({{ $thread->author->avatar }})" @endif>{{ $thread->author->getInitials() }}</div>
                <div class="forum__thread-info">
                    <h3 class="forum__thread-title"><a href="{{ route('forum-thread-view', ['id' => $thread->id]) }}">{{ $thread->title }}</a></h3>
                    <div class="forum__thread-meta">
                        <a href="{{ route('user-view', ['id' => $thread->author->id]) }}">{{ $thread->author->name }}</a>
                        <time datetime="{{ $thread->created_at->format('Y-m-d\TH:i:s.uP') }}">{{ $thread->created_at->ago() }}</time>
                        <span>— {{ $thread->views}} {{ trans_choice('просмотр|просмотра|просмотров', $thread->views, [], 'ru') }}, {{ $thread->replies_count > 0 ? trans_choice('ответ|ответа|ответов', $thread->replies_count, [], 'ru') : 'нет ответов' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $threads->onEachSide(0)->links() }}
        </div>
    </section>
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        @auth
        <section class="section">
            <a href="{{ route('forum-thread-create') }}" class="button primary" data-ajax>Создать тему</a>
        </section>
        @endauth
        <section class="section">
            <div class="section__title">Статистика</div>
            <div class="data data_compact">
                <div class="data__icon icon icon--comment"></div>
                <div class="data__info">
                    <p class="data__value">{{ $threads->count() }}</p>
                    <p class="data__desc">Всего тем</p>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--comments"></div>
                <div class="data__info">
                    <p class="data__value">{{ $threads->replies_count ?? '0' }}</p>
                    <p class="data__desc">Сообщений</p>
                </div>
            </div>
        </section>
    </div>
</aside>
@endsection