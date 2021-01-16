@extends('layouts.app')

@section('content')
<div class="content">
    <form method="post" action="{{ route('search') }}">
        <input type="search" placeholder="Введите слово или фразу для поиска...">
    </form>
</div>
@endsection