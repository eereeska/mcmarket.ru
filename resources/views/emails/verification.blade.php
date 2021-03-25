<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добро пожаловать</title>
</head>
<body>
    <h2>Добро пожаловать в сообщество <a href="{{ route('home') }}">MCMarket</a>, {{ $user->name }}</h2>
    <p>Пожалуйста, <a href="{{ route('user.email.verification.verify', ['token' => sha1($user->email)]) }}">подтвердите свой аккаунт</a></p>
</body>
</html>