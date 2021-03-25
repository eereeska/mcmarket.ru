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
        <section class="section section_small">
            <input type="email" name="email" placeholder="Почта" value="{{ old('email') }}" minlength="3" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="on" required class="input">
            @if ($errors->has('email'))
                <p class="alert red small">{{ $errors->first('email') }}</p>
            @endif
        </section>
        <section class="section section_small">
            <input type="text" name="username" placeholder="Никнейм" value="{{ old('username') }}" minlength="3" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="on" required class="input">
            @if ($errors->has('name'))
                <p class="alert red small">{{ $errors->first('username') }}</p>
            @endif
        </section>
        <section class="section section_small">
            <input type="password" name="password" placeholder="Пароль" autocomplete="new-password" required class="input">
            @if ($errors->has('password'))
                <p class="alert red small">{{ $errors->first('password') }}</p>
            @endif
        </section>
        <section class="section section_small">
            <p class="center mt-30 mb-30">Создавая аккаунт, Вы соглашаетесь с <a href="{{ route('terms') }}" target="_blank">правилами MCMarket</a> и выражаете согласие на <a href="#" target="_blank">обработку персональных данных</a>.</p>
            @if ($errors->has('create_error'))
                <p class="alert red small">{{ $errors->first('create_error') }}</p>
            @endif
            <button type="submit" class="button primary">Создать аккаунт</button>
        </section>
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