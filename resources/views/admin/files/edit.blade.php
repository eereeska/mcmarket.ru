@extends('layouts.admin')

@section('content')
<div class="content">
{{ $file }}
</div>
<aside class="sidebar">
    <div class="sidebar__innner sidebar__inner--sticky">
        <section class="section">
            <h2 class="section__title">Информация</h2>
            <button class="button primary">Сохранить</button>
        </section>
    </div>
</aside>
@endsection