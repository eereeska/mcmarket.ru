@extends('layouts.app', ['page_classes' => 'auth_form'])

@section('content')
<div class="content">
    <div class="section_title">
        <h4>Авторизация</h4>
        <a href="{{ route('register') }}">Регистрация</a>
    </div>
    <form method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <input type="text" name="name" placeholder="Никнейм" value="{{ old('name') }}" minlength="3" maxlength="24" autocapitalize="none" autocorrect="off" autocomplete="username" required>
        <input type="password" name="password" placeholder="Пароль" autocomplete="password" required>
        @if ($errors->any())
            <p class="alert red small">{{ $errors->first() }}</p>
        @endif
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