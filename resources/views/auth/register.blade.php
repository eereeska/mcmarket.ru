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
            <form id="register-form" method="post" action="{{ route('register') }}">
                {{ csrf_field() }}
                <section class="section section_small">
                    <input type="text" name="username" placeholder="Никнейм" value="{{ old('username') }}" minlength="3" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="on" required class="input">
                    @if ($errors->has('username'))
                    <p class="alert red small">{{ $errors->first('username') }}</p>
                    @endif
                </section>
                <section class="section section_small">
                    <input type="password" name="password" placeholder="Пароль" autocomplete="new-password" required class="input">
                    @if ($errors->has('password'))
                    <p class="alert red small">{{ $errors->first('password') }}</p>
                    @endif
                </section>
                @if ($errors->has('h-captcha-response'))
                <p class="alert red small">{{ $errors->first('h-captcha-response') }}</p>
                @endif
                <section class="section section_small">
                    <p class="center mt-30 mb-30">Создавая аккаунт, Вы соглашаетесь с <a href="{{ route('terms') }}" target="_blank">правилами MCMarket</a> и выражаете согласие на <a href="#" target="_blank">обработку персональных данных</a>.</p>
                    @if ($errors->has('create_error'))
                        <p class="alert red small">{{ $errors->first('create_error') }}</p>
                    @endif
                    <script>
                        function onSubmit() {
                            document.getElementById('register-form').submit();
                        }
                    </script>
                    <button type="submit" class="button primary h-captcha" data-sitekey="5c123643-0349-474e-a131-30368a03f91c" data-size="invisible" data-callback="onSubmit">Создать аккаунт</button>
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