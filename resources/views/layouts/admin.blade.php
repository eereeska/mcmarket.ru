<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACP</title>

    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('header_scripts')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <a href="{{ route('home') }}" class="header__logo">MCMarket</a>
                <nav class="header__nav">
                    <a href="#" @if (request()->is('u*')) class="active" @endif>Пользователи</a>
                    <a href="{{ route('groups-index') }}" @if (request()->is('group*')) class="active" @endif>Сообщества</a>
                </nav>
            </div>
            <div class="header__right">
                <a href="#" class="header__notifications icon icon--bell"></a>
                <a href="{{ route('user-show', ['name' => Auth::user()->name ]) }}" class="header__profile">
                    @include('components._avatar', ['user' => Auth::user()])
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    </header>
    <main id="root" class="page {{ $page_classes ?? '' }}">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="footer__inner">
            <div class="footer__left">
                <a href="{{ route('home') }}" class="footer__link">Minecraft Маркет &copy {{ now()->format('Y') }} MCMarket.ru</a>
            </div>
            <div class="footer__right">
                <a href="{{ route('contact') }}" class="footer__link">Контакты</a>
                <a href="{{ route('terms') }}" class="footer__link">Условия и правила</a>
                <a href="{{ route('privacy') }}" class="footer__link">Политика конфиденциальности</a>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer_scripts')
</body>
</html>