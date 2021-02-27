@include('components._select', [
    'label' => 'Статус',
    'name' => 'status',
    'submit' => true,
    'reset' => true,
    'default' => 'Не выбран',
    'selected' => request()->get('status'),
    'options' => [
        'hidden' => 'Скрыт',
        'pending' => 'На рассмотрении',
        'approved' => 'Одобрен'
    ]
])