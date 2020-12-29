@extends('layouts.app')

@section('content')
{{ $thread->title }}
<hr>
{!! $thread->body !!}
@endsection