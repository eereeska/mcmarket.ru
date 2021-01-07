<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' — Minecraft Маркет' : 'Minecraft Маркет' }}</title>

    @if (isset($seo['robots']))
        <meta name="robots" content="{{ $seo['robots'] }}" />
    @endif

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

    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}" />
    
    {{-- @include('misc.metrics') --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('header_scripts')
</head>
<body>
    <header>
        @auth
        <div class="main">
            <a href="{{ route('home') }}" class="logo" data-ajax>Minecraft Маркет</a>
            <a href="#" class="notifications icon icon--bell"></a>
            <a href="{{ route('user-view', ['id' => Auth::user()->id ]) }}" class="profile">
                <div class="avatar" {{ Auth::user()->avatar ? 'style="background-image: url(' . Auth::user()->avatar . ')"' : '' }}>{{ Auth::user()->getInitials() }}</div>
                <span>{{ Auth::user()->name }}</span>
            </a>
        </div>
        @endauth
        <div class="nav">
            <nav>
                <a href="{{ route('home') }}" class="active">Форум</a>
                <a href="#">Загрузки</a>
                <a href="#">Пользователи</a>
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
        <div class="links">
            <a href="{{ route('home') }}">Minecraft Маркет &copy {{ now()->format('Y') }} MCMarket.ru</a>
            <a href="#">Контакты</a>
            <a href="#">Условия и правила</a>
            <a href="#">Политика конфиденциальности</a>
        </div>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer_scripts')
</body>
</html>