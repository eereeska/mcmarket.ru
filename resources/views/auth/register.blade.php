@extends('layouts.app')

@section('meta.title', 'Регистрация')

@section('content')
<div class="content content_auth">
    <section class="section">
        <div class="section__header">
            <h1 class="section__title">Регистрация</h1>
            <a href="{{ route('login') }}">Уже есть аккаунт?</a>
        </div>
        <div class="section__content">
            <form id="auth-form" method="post" action="{{ route('register') }}">
                {{ csrf_field() }}
                <section class="section section_small">
                    <input type="text" name="username" placeholder="Никнейм" value="{{ old('username') }}" minlength="3" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="on" required class="input">
                </section>
                <section class="section section_small">
                    <input type="password" name="password" placeholder="Пароль" autocomplete="new-password" required class="input">
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
                <section class="section section_small">
                    <p class="center mt-30 mb-30">Создавая аккаунт, Вы соглашаетесь с <a href="{{ route('terms') }}" target="_blank">правилами и условиями MCMarket</a></p>
                    <script>
                        function onSubmit() {
                            document.getElementById('auth-form').submit();
                        }
                    </script>
                    <button type="submit" class="button primary h-captcha" data-sitekey="{{ config('mcm.hcaptcha.public_key') }}" data-size="invisible" data-callback="onSubmit">Создать аккаунт</button>
                    <script src="https://hcaptcha.com/1/api.js" async defer></script>
                    {{-- @include('components._hcaptcha') --}}
                </section>
            </form>
            {{-- <p class="center mt-60 mb-30">Через соц. сети</p>
            <div class="social_links grid">
                <a href="#" class="vk"></a>
                <a href="#" class="fb"></a>
                <a href="#" class="google"></a>
                <a href="#" class="yandex"></a>
            </div> --}}
        </div>
    </section>
</div>
@endsection