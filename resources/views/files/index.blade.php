@extends('layouts.app')

@section('content')
<div class="content">
    @forelse ($files as $file)
        <a href="{{ route('file-show', ['id' => $file->id]) }}">{{ $file->short_title }}</a>
    @empty
        <p class="empty">Пусто</p>
    @endforelse
</div>
<div class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        @if (Auth::check())
        <section class="section">
            <a href="{{ route('files-submit') }}" class="button primary">Добавить файл</a>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Категории</h2>
            </div>
            <div class="section__content">
                @foreach ($categories as $category)
                <a href="#" class="data data_compact">
                    <div class="data__icon icon icon--{{ $category->icon }}"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $category->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection