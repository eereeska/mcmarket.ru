@extends('layouts.app', [
    'seo' => [
        'keywords' => 'форум, майнкрафт, minecraft, обсуждения'
    ]
])

@section('content')
<div class="content">
    <section class="section">
        <form method="post" action="{{ route('search', ['section' => 'forum']) }}" data-action="search" data-result="#threads">
            <input type="hidden" name="page" value="{{ request()->page ?? 1 }}">
            <h2 class="section__title">
                @include('components.select', [
                    'name' => 'order',
                    'label' => 'Сортировка',
                    'selected' => in_array(request()->order, ['last_reply', 'newest', 'most_viwed', 'most_discussed']) ? request()->order : 'last_reply',
                    'options' => [
                        'last_reply' => 'Новые ответы',
                        'newest' => 'Новые темы',
                        'most_viewed' => 'Популярное',
                        'most_discussed' => 'Обсуждаемое'
                    ]
                ])
                
            </h2>
            <div class="fluid fluid--wrap gap-1">
                @include('components._tags', ['tags' => $tags, 'class' => 'fluid'])
            </div>
        </form>
    </section>
    <section class="section">
        <h2 class="section__title">Обсуждения</h2>
        {{-- <div class="dropdown">
            <button class="dropdown__title">Новые сообщения</button>
            <ul class="dropdown__content">
                <li class="dropdown__item"><a href="#">Новые темы</a></li>
                <li class="dropdown__item"><a href="#">Самые просматриваемые</a></li>
                <li class="dropdown__item"><a href="#">Самые обсуждаемые</a></li>
            </ul>
        </div> --}}
        <div id="threads" class="list">
            @include('forum._threads', ['threads' => $threads])
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
            <h2 class="section__title">Статистика</h2>
            <div class="data data_compact">
                <div class="data__icon icon icon--comment"></div>
                <div class="data__info">
                    <span class="data__value">{{ $threads->count() }}</span>
                    <span class="data__desc">Всего тем</span>
                </div>
            </div>
            <div class="data data_compact">
                <div class="data__icon icon icon--comments"></div>
                <div class="data__info">
                    <span class="data__value">{{ $threads->replies_count ?? '0' }}</span>
                    <span class="data__desc">Сообщений</span>
                </div>
            </div>
        </section>
    </div>
</aside>
@endsection