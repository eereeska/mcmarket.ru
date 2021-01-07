@extends('layouts.app')

@section('content')
<div class="content">
    <h1>{{ $thread->title }}</h1>
    Теги: @foreach($thread->tags as $tag) {{ $tag->tag->title }} @endforeach
    <hr>
    Просмотры: {{ $thread->views }}
    <hr>
    <article>{!! $thread->body !!}</article>
</div>
@endsection