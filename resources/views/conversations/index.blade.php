@extends('layouts.app')

@section('meta.title', 'Диалоги')
@section('meta.robots', 'noindex')

@section('content')
<aside class="sidebar">
    @include('components.conversations._conversations', ['conversations' => $conversations])
</aside>
<div class="content">

</div>
@endsection