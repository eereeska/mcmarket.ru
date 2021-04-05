@extends('layouts.app')

@section('meta.title', 'Авторизация')

@section('content')
@if ($errors->any())
    <aside class="sidebar">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </aside>
@endif
<div class="content content_auth">
    <div class="section_title">
        <h4>Авторизация</h4>
        <a href="{{ route('register') }}">Регистрация</a>
    </div>
    <form method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <section class="section section_small">
            <input class="input" type="text" name="name" placeholder="Никнейм" value="{{ old('name') }}" minlength="3" maxlength="24" autocapitalize="none" autocorrect="off" autocomplete="username" required>
        </section>
        <section class="section section_small">
            <input class="input" type="password" name="password" placeholder="Пароль" autocomplete="password" required>
        </section>
        <button type="submit" class="button primary">Войти</button>
    </form>
    <p class="center mt-60 mb-30">Через соц. сети</p>
    <div class="social_links grid">
        <a href="#" class="vk"></a>
        <a href="#" class="fb"></a>
        <a href="#" class="google"></a>
        <a href="#" class="yandex"></a>
    </div>
</div>
@endsection