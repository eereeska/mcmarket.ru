<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' — Minecraft Маркет' : 'Minecraft Маркет' }}</title>

    @yield('meta.robots')

    @if (isset($seo['description']))
        <meta name="description" content="{{ strlen($seo['description']) > 157 ? substr($seo['description'], 0, 50) . '...' : $seo['description'] }}">
        <meta property="og:description" content="{{ $seo['description'] }}">
    @else
        <meta name="description" content="Настоящий Маркет в мире Minecraft: Покупайте, продавайте, устраивайте розыгрыши и раздавайте любые товары и услуги, связанные с игрой Minecraft">
        <meta property="og:description" content="Настоящий Маркет в мире Minecraft: Покупайте, продавайте, устраивайте розыгрыши и раздавайте любые товары и услуги, связанные с игрой Minecraft">
    @endif

    @if (isset($seo['keywords']))
        <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif

    <meta property="og:site_name" content="Minecraft Маркет">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="object">
    <meta name="twitter:card" content="summary_large_image" />

    <meta name="theme-color" content="#F1F3FA">
    <meta name="msapplication-TileColor" content="#5FA1D0">

    <meta name="application-name" content="Minecraft Маркет">
    <meta name="apple-mobile-web-app-title" content="Minecraft Маркет">

    <link rel='shortcut icon' href='{{ asset('favicon.ico') }}' type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- <meta property="og:image" content="https://dne4i5cb88590.cloudfront.net/invisionpower-com/monthly_2019_09/og.jpg.5e6c57e8dfa140ce4ac18f1e757d3b45.jpg">
    <meta property="og:url" content="https://invisioncommunity.com/forums/topic/459918-kindness-plugin/">
    <meta property="og:updated_time" content="2020-12-27T08:43:06Z">

    <link rel="first" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="prev" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="next" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />
	<link rel="last" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />

    <link rel="alternate" type="application/rss+xml" title="Invision Community News" href="https://invisioncommunity.com/rss/1-invision-community-news.xml/" />

    <link rel="manifest" href="https://invisioncommunity.com/manifest.webmanifest/">
    <meta name="msapplication-config" content="https://invisioncommunity.com/browserconfig.xml/">
    <meta name="msapplication-starturl" content="/forums/">
    

    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}" /> --}}
    
    {{-- @include('misc.metrics') --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('header_scripts')
</head>
<body>
    <header class="header">
        @auth
            <div class="header__main">
                <a href="{{ route('home') }}" class="header__logo">Minecraft Маркет</a>
                <a href="#" class="header__notifications icon icon--bell"></a>
                <a href="{{ route('user-show', ['name' => Auth::user()->name ]) }}" class="header__profile">
                    @include('components._avatar', ['user' => Auth::user()])
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>
        @endauth
        <div class="header__nav">
            <nav class="header-nav">
                <a href="{{ route('home') }}" @if (request()->is('/')) class="active" @endif>Форум</a>
                <a href="#" @if (request()->is('/')) class="active" @endif>Загрузки</a>
                <a href="#" @if (request()->is('u*')) class="active" @endif>Пользователи</a>
                <a href="{{ route('search') }}" class="search icon icon--search"></a>
                @guest
                    <a href="{{ route('login') }}" class="login icon icon--login"></a>
                    <a href="{{ route('register') }}" class="register icon icon--register"></a>
                @endguest
            </nav>
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