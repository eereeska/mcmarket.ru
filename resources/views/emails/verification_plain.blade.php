Добро пожаловать в сообщество MCMarket, {{ $user->name }}

Пожалуйста, подтвердите свой аккаунт, скопировав и вставив ссылку в адресную строку браузера:
{{ route('user.email.verification.verify', ['token' => sha1($user->email)]) }}