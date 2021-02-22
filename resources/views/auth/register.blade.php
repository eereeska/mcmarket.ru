@extends('layouts.app')

@section('meta.title', 'Регистрация')

@section('content')
<div class="content content_auth-form">
    <div class="section_title">
        <h4>Регистрация</h4>
        <a href="{{ route('login') }}">Уже есть аккаунт?</a>
    </div>
    <form method="post" action="{{ route('register') }}">
        {{ csrf_field() }}
        <input type="text" name="name" placeholder="Никнейм" value="{{ old('name') }}" minlength="3" maxlength="24" autocapitalize="none" autocorrect="off" autocomplete="username" required>
        @if ($errors->has('name'))
            <p class="alert red small">{{ $errors->first('name') }}</p>
        @endif
        <input type="password" name="password" placeholder="Пароль" autocomplete="password" required>
        @if ($errors->has('password'))
            <p class="alert red small">{{ $errors->first('password') }}</p>
        @endif
        @if ($errors->has('create_error'))
            <p class="alert red small">{{ $errors->first('create_error') }}</p>
        @endif
        <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" autocomplete="password" required>
        <p class="center mt-30 mb-30">Создавая аккаунт, я соглашаюсь с <a href="{{ route('terms') }}" target="_blank">правилами MCMarket</a> и даю согласие на <a href="#" target="_blank">обработку персональных данных</a>.</p>
        <button type="submit" class="button primary">Создать аккаунт</button>
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