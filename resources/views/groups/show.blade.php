@extends('layouts.app', [
    'title' => $group->name
])

@section('content')
<div class="content">
    <section class="section">
        <h1>{{ $group->name }}</h1>
        @if (!is_null($group->description))
        <p>{!! nl2br($group->description) !!}</p>
        @endif
    </section>
    <section class="section">
        <div class="tabs">
            <a href="#news" class="tabs__tab active">Новости</a>
            <a href="#reviews" class="tabs__tab">Отзывы</a>
        </div>
        <div class="tabs__content">
            <div id="news" class="list tab-active">Lorem ipsum dolor sit amet.</div>
            <div id="reviews" class="list">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, reprehenderit.</div>
        </div>
    </section>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="avatar large" style="background-image: url({{ asset('covers/' . $group->cover) }})"></div>
        </section>
        <section class="section">
            <h2 class="section__title">Информация</h2>
            <div class="data data_compact">
                <div class="data__icon icon icon_clock"></div>
                <div class="data__info">
                    <span class="data__value" title="{{ $group->created_at->format('h:i:s') }}">{{ $group->created_at->format('d.m.Y') }}</span>
                    <span class="data__desc">Дата создания</span>
                </div>
            </div>
        </section>
    </div>
</aside>
@endsection