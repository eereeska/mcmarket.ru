<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACP</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <a href="{{ route('admin.index') }}" class="header__logo">ACP</a>
                <nav class="header__nav">
                    <a href="#" @if (request()->is('u*')) class="active" @endif>Пользователи</a>
                    <a href="{{ route('groups-index') }}" @if (request()->is('group*')) class="active" @endif>Сообщества</a>
                </nav>
            </div>
            <div class="header__right">
                <a href="{{ route('user.show', ['user' => auth()->user() ]) }}" class="header__profile">
                    @include('components._avatar', ['user' => auth()->user()])
                    <span>{{ auth()->user()->name }}</span>
                </a>
            </div>
        </div>
    </header>
    <main class="page">
        @yield('content')
    </main>
    @include('components._footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>