@extends('layouts.app', [
    'page_classes' => 'discussion',
    'title' => $thread->title
])

@section('content')
<div class="content">
    <h1>{{ $thread->title }}</h1>
    <div class="fluid fluid--wrap gap-1">
        @include('components.tags', ['tags' => $thread->tags, 'fluid' => false])
    </div>
    <hr>
    Просмотры: {{ $thread->views }}
    <hr>
    <article><p>{!! $thread->body !!}</p></article>
</div>
@endsection