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

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">

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

    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 font-sans antialiased">
    <header class="flex bg-white border-b-2 border-gray-200 px-4 lg:px-0">
        <div class="flex justify-between w-full max-w-screen-lg mx-auto py-3">
            <div class="flex flex-grow justify-between items-center space-x-4">
                <a href="{{ route('home') }}" class="text-2xl font-bold focus:outline-none focus:text-blue-500">MCМаркет</a>
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('groups.index') }}" class="focus:outline-none focus:text-blue-500">Сообщества</a>
                </nav>
                @guest
                    <div class="flex">
                        <a href="{{ route('login') }}" @if (request()->is('login')) class="active" @endif>Вход</a>
                        <a href="{{ route('register') }}" @if (request()->is('register')) class="active" @endif>Регистрация</a>
                    </div>
                @else
                    <a href="{{ route('user.show', ['name' => auth()->user()->name ]) }}" class="flex items-center space-x-2 focus:outline-none focus:text-blue-500">
                        <div class="w-8 h-8 rounded bg-cover bg-no-repeat bg-center" style="background-image: url({{ auth()->user()->getAvatar() }});"></div>
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                @endguest
            </div>
        </div>
    </header>
    @yield('content')
    @include('components._footer')
    @yield('footer.scripts')
</body>
</html>