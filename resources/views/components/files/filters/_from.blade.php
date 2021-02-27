@include('components._select', [
    'label' => 'От пользователя',
    'name' => 'from',
    'submit' => true,
    'default' => 'Не указан',
    'selected' => 'none',
    'search' => [
        'url' => route('search.users')
    ]
])