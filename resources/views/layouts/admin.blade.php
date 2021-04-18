<!DOCTYPE html>
<html dir="ltr" lang="ru" data-csrf="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACP</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="flex flex-col h-screen bg-gray-100">
    <header class="flex bg-white border-b-2 border-gray-200 px-4 lg:px-0">
        <div class="flex justify-between w-full max-w-screen-lg mx-auto py-3">
            <div class="flex flex-grow justify-between items-center space-x-4">
                <a href="{{ route('admin.index') }}" class="text-2xl font-bold">ACP</a>
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('admin.users.index') }}" @if (request()->is('admin/users*')) class="active" @endif>Пользователи</a>
                    <a href="{{ route('groups-index') }}" @if (request()->is('group*')) class="active" @endif>Сообщества</a>
                    <a href="{{ route('user.show', ['name' => auth()->user()->name ]) }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded bg-cover bg-no-repeat bg-center" style="background-image: url({{ auth()->user()->getAvatar() }});"></div>
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
    @include('components._footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>