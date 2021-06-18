@extends('layouts.app')

@section('meta.title', 'Авторизация')

@section('content')
<main class="w-full max-w-screen-lg mx-auto px-4 my-12 lg:px-0">
    <form action="{{ url()->current() }}" method="post" class="w-full md:w-2/5 mx-auto">
        @csrf
        @if (request()->has('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif
        <div class="flex justify-between items-center space-x-4 mb-6">
            <div class="text-xl font-bold">Авторизация</div>
            <a href="{{ route('register') }}" class="hover:text-blue-600">Ещё нет аккаунта?</a>
        </div>
        <div class="mb-6">
            <label for="username" class="block mb-3 text-gray-500">Никнейм</label>
            <input type="text" name="username" placeholder="Иван" value="{{ old('username') }}" required minlength="3" maxlength="16" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
            @if ($errors->has('username'))
                <p class="mt-2 text-red-600">{{ $errors->first('username') }}</p>
            @endif
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-3 text-gray-500">Пароль</label>
            <input type="password" name="password" placeholder="******" required minlength="6" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
            @if ($errors->has('password'))
                <p class="mt-2 text-red-600">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="mb-6">
            {{-- <div class="h-captcha flex justify-center" data-sitekey="{{ config('mcm.hcaptcha.public_key') }}"></div> --}}
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            {{-- <script src="https://hcaptcha.com/1/api.js" async defer></script> --}}
            @if ($errors->has('g-captcha-response'))
                <p class="mt-2 text-center text-red-600">{{ $errors->first('h-captcha-response') }}</p>
            @endif
        </div>
        @if ($errors->has('wrong_credentials'))
            <div class="mb-6">
                <p class="mt-2 text-center text-red-600">{{ $errors->first('wrong_credentials') }}</p>
            </div>
        @endif
        <script>
            function onSubmit() {
                document.querySelector('form').submit();
            }
        </script>
        <button type="submit" class="g-recaptcha w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:border-blue-300" data-sitekey="{{ config('services.recaptcha.sitekey') }}" data-callback="onSubmit">Войти</button>
    </form>
</main>
@endsection