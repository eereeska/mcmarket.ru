@extends('layouts.app')

@section('meta.title', 'Диалоги')
@section('meta.robots', 'noindex')

@section('content')
<aside class="sidebar">
    @foreach ($conversations as $conversation)
    {{$conversation}}
    @endforeach
</aside>
<div class="content">

</div>
@endsection