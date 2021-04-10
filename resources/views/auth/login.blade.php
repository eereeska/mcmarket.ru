@extends('layouts.app')

@section('meta.title', 'Авторизация')

@section('content')
<div class="content content_auth">
    <div class="section_title">
        <h4>Авторизация</h4>
        <a href="{{ route('register') }}">Регистрация</a>
    </div>
    <form id="auth-form" method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <section class="section section_small">
            <input class="input" type="text" name="username" placeholder="Никнейм" value="{{ old('username') }}" minlength="3" maxlength="24" autocapitalize="none" autocorrect="off" autocomplete="username" required>
        </section>
        <section class="section section_small">
            <input class="input" type="password" name="password" placeholder="Пароль" autocomplete="password" required>
        </section>
        @if ($errors->any())
            <section class="section section_compact">
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
        <script>
            function onSubmit() {
                document.getElementById('auth-form').submit();
            }
        </script>
        <button type="submit" class="button primary h-captcha" data-sitekey="{{ config('mcm.hcaptcha.public_key') }}" data-size="invisible" data-callback="onSubmit">Войти</button>
        <script src="https://hcaptcha.com/1/api.js" async defer></script>
    </form>
    {{-- <p class="center mt-60 mb-30">Через соц. сети</p>
    <div class="social_links grid">
        <a href="#" class="vk"></a>
        <a href="#" class="fb"></a>
        <a href="#" class="google"></a>
        <a href="#" class="yandex"></a>
    </div> --}}
</div>
@endsection