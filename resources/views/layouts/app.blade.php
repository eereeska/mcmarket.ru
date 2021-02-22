<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta.title', 'Minecraft Маркет')</title>

    @hasSection ('meta.robots')
    <meta name="robots" content="@yield('meta.robots')">
    @endif

    <meta name="description" content="@yield('meta.description', 'Настоящий Маркет в мире Minecraft: Покупайте, продавайте, устраивайте розыгрыши и раздавайте любые товары и услуги, связанные с игрой Minecraft')">
    <meta name="keywords" content="@yield('meta.keywords', 'Minecraft, Market, Майнкрафт, Маркет')">
    
    <meta property="og:site_name" content="Minecraft Маркет">
    <meta property="og:description" content="@yield('meta.description', 'Настоящий Маркет в мире Minecraft: Покупайте, продавайте, устраивайте розыгрыши и раздавайте любые товары и услуги, связанные с игрой Minecraft')">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="object">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection ('meta.og:updated_time')
    <meta name="og:updated_time" content="@yield('meta.og:updated_time')">
    @endif
    @hasSection ('meta.og:image')
    <meta name="og:image" content="@yield('meta.og:image')">
    @endif

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="theme-color" content="#F1F3FA">
    <meta name="msapplication-TileColor" content="#5FA1D0">
    <meta name="msapplication-starturl" content="/">

    <meta name="application-name" content="Minecraft Маркет">
    <meta name="apple-mobile-web-app-title" content="Minecraft Маркет">

    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel='shortcut icon' href='{{ asset('favicon.ico') }}' type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- 

    <link rel="first" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="prev" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="next" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />
	<link rel="last" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />

    <link rel="alternate" type="application/rss+xml" title="Invision Community News" href="https://invisioncommunity.com/rss/1-invision-community-news.xml/" />

    <link rel="manifest" href="https://invisioncommunity.com/manifest.webmanifest/">
    <meta name="msapplication-config" content="https://invisioncommunity.com/browserconfig.xml/">

    {{-- @include('misc.metrics') --}}

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
                    @if (Auth::guest())
                    <a href="{{ route('login') }}" @if (request()->is('login')) class="active" @endif>Вход</a>
                    <a href="{{ route('register') }}" @if (request()->is('register')) class="active" @endif>Регистрация</a>
                    @endif
                </nav>
            </div>
            @if (Auth::check())
            <div class="header__right">
                {{-- <a href="{{ route('conversations.index') }}" class="header__conversations icon icon--comments"></a> --}}
                <a href="{{ route('user.show', ['user' => auth()->user() ]) }}" class="header__profile">
                    @include('components._avatar', ['user' => auth()->user()])
                    <span>{{ auth()->user()->name }}</span>
                </a>
            </div>
            @endif
        </div>
    </header>
    <main class="page">
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
    <script src="{{ asset('js/vue.js') }}"></script>
    @yield('footer_scripts')
</body>
</html>