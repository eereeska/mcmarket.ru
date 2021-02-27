@include('components._select', [
    'label' => 'Тип',
    'name' => 'type',
    'submit' => true,
    'reset' => true,
    'default' => 'Не выбран',
    'selected' => request()->get('type', 'none'),
    'options' => [
        'free' => 'Бесплатные',
        'paid' => 'Платные',
        'nulled' => 'Nulled'
    ]
])