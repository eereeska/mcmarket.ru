@extends('layouts.app')

@section('content')
<div class="content">
    @forelse ($groups as $group)
    <div class="data">
        <div class="data__info">
            <h3 class="data__value"><a href="{{ route('group-show', ['slug' => $group->slug]) }}">{{ $group->name }}</a></h3>
        </div>
    </div>
    @empty
    <p class="alert empty small">Ничего не найдено</p>
    @endforelse
    {{ $groups->onEachSide(0)->links() }}
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar--sticky">
        <section class="section">
            <a href="{{ route('group-create') }}" class="button primary">Создать сообщество</a>
        </section>
    </div>
</aside>
@endsection