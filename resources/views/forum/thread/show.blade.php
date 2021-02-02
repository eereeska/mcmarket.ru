@extends('layouts.app', [
    'page_classes' => 'discussion',
    'title' => $thread->title
])

@section('content')
<div class="content forum">
    <section class="section">
        <article class="article">
            <h1>{{ $thread->title }}</h1>
            <div class="data">
                @include('components._avatar', ['user' => $thread->author])
                <div class="data__info">
                    <h2 class="data__value">
                        <a href="{{ route('user-show', ['name' => $thread->author->name]) }}">{{ $thread->author->name }}</a>
                    </h2>
                    <div class="data__desc">
                        <time datetime="{{ $thread->created_at->format('Y-m-d\TH:i:s.uP') }}">{{ $thread->created_at->ago() }}</time>
                        <span>— {{ $thread->views}} {{ trans_choice('просмотр|просмотра|просмотров', $thread->views, [], 'ru') }}</span>
                    </div>
                </div>
            </div>
            <div class="fluid fluid--wrap gap-1">
                @include('components._tags', ['tags' => $thread->tags, 'disabled' => true, 'class' => 'disabled'])
            </div>
            <p>{!! $thread->body !!}</p>
        </article>
    </section>
    @if ($thread->replies_count > 0)
    <section class="section">
        <h2 class="section__title">Ответы <span class="muted">{{ $thread->replies_count }}</span></h2>
        <div id="replies" class="list">
            @each('forum._replies', $thread->replies, 'reply', 'components._empty')
        </div>
    </section>
    @endif
    <section class="section">
        <form action="{{ route('forum-thread-reply', ['id' => $thread->id]) }}" method="post">
            @csrf
            {{-- <div class="comment">
                @include('components._avatar', ['user' => Auth::user()])
                <div class="comment__info">
                    <h3 class="comment__label">Ваш ответ</h3>
                    <div class="comment__body comment__body--editable" contenteditable="true" placeholder="Введите сообщение и нажмите Ctrl + Enter для отправки"></div>
                </div>
            </div> --}}
            <textarea id="ta" type="text" name="body" placeholder="Сообщение" autocomplete="off" required class="auto-resize">{{ old('body' )}}</textarea>
            {{-- <div class="editor"> --}}
                {{-- <div class="editor__content" data-name="body" placeholder="Сообщение" dir="auto" contenteditable="true" spellcheck="true"></div> --}}
            {{-- </div> --}}
            {{-- <button class="button primary">Отправить</button> --}}
        </form>
    </section>
</div>
@endsection