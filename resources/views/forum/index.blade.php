@extends('layouts.app')

@section('content')
<div class="section_title">
    <h4>Теги</h4>
</div>
<div class="tags">
    <a href="#" class="tag discussions">Обсуждения</a>
    <a href="#" class="tag ideas">Идеи</a>
    <a href="#" class="tag plugins">Плагины</a>
    <a href="#" class="tag graphics">Графика</a>
    <a href="#" class="tag buildings">Строительство</a>
    <a href="#" class="tag accounts">Аккаунты</a>
    <a href="#" class="tag news">Новости</a>
    <a href="#" class="tag giveaways">Розыгрыши</a>
    <a href="#" class="tag buying">Покупка</a>
    <a href="#" class="tag selling">Продажа</a>
</div>
<div class="section_title">
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
        <div class="avatar" style="background-image: url(https://dne4i5cb88590.cloudfront.net/invisionpower-com/profile/photo-thumb-53063.jpg)"></div>
        <div class="forum__thread-info">
            <h3 class="forum__thread-title"><a href="{{ route('forum-thread-view', ['id' => $thread->id]) }}">{{ $thread->title }}</a></h3>
            <div class="forum__thread-meta">
                <a href="{{ route('user-view', ['id' => $thread->author->id]) }}">{{ $thread->author->name }}</a>
                <time datetime="{{ $thread->created_at->format('Y-m-d\TH:i:s.uP') }}">{{ $thread->created_at->ago() }}</time>
            </div>
        </div>
    </div>
    @endforeach
    {{ $threads->onEachSide(0)->links() }}
</div>
@endsection

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        <a href="{{ route('forum-thread-create') }}" class="button primary">Создать тему</a>
    </div>
</aside>
@endsection