<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Minecraft Маркет' }}</title>

    {{--  --}}
    {{-- <meta name="description" content="">
    <meta name="keywords" content="">

    <meta property="og:image" content="https://dne4i5cb88590.cloudfront.net/invisionpower-com/monthly_2019_09/og.jpg.5e6c57e8dfa140ce4ac18f1e757d3b45.jpg">
    <meta property="og:site_name" content="Invision Community">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="object">
    <meta property="og:url" content="https://invisioncommunity.com/forums/topic/459918-kindness-plugin/">
    <meta property="og:updated_time" content="2020-12-27T08:43:06Z">
    <meta property="og:description" content="description">

    <meta name="twitter:card" content="summary_large_image" />

    <link rel="first" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="prev" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/" />
	<link rel="next" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />
	<link rel="last" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/3/" />
	<link rel="canonical" href="https://invisioncommunity.com/forums/topic/458304-ms-ie-warning/page/2/" />

    <link rel="alternate" type="application/rss+xml" title="Invision Community News" href="https://invisioncommunity.com/rss/1-invision-community-news.xml/" />

    <link rel="manifest" href="https://invisioncommunity.com/manifest.webmanifest/">
    <meta name="msapplication-config" content="https://invisioncommunity.com/browserconfig.xml/">
    <meta name="msapplication-starturl" content="/forums/">
    <meta name="application-name" content="Invision Community">
    <meta name="apple-mobile-web-app-title" content="Invision Community">
	<meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    
    <link rel='shortcut icon' href='//dne4i5cb88590.cloudfront.net/invisionpower-com/monthly_2019_01/favicon.ico' type="image/x-icon"> --}}
    {{--  --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="header">
        @auth
        <div class="header__main">
            <a href="{{ route('home') }}" class="header__logo">Minecraft Маркет</a>
            <a href="#" class="header__notifications"></a>
            <a href="#" class="header-profile">
                <div class="header-profile__avatar" style="background-image: url(https://dne4i5cb88590.cloudfront.net/invisionpower-com/monthly_2020_02/pixiv13975860.thumb.jpg.9b3d08c3bb6bc1838adac3a58d0d4a5e.jpg)"></div>
                <span>{{ Auth::user()->name }}</span>
            </a>
        </div>
        @endauth
        <div class="header__nav">
            <nav class="header-nav">
                <a href="{{ route('home') }}" class="active">Форумы</a>
                <a href="#">Загрузки</a>
                <a href="#">Пользователи</a>
                <a href="#" class="search"></a>
            </nav>
        </div>
    </header>
    <main class="content {{ $content_classes ?? '' }}">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="footer__inner">
            <a href="/">Minecraft Маркет &copy 2020 MCMarket.ru</a>
            <a href="#">Контакты</a>
            <a href="#">Условия и правила</a>
            <a href="#">Политика конфиденциальности</a>
        </div>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>