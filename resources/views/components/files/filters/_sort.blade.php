@include('components._select', [
    'label' => 'Сортировка',
    'name' => 'sort',
    'submit' => true,
    'default' => 'update_down',
    'selected' => request()->get('sort', 'update_down'),
    'options' => [
        'update_down' => 'Последнее обновление',
        'new_down' => 'Новые',
        'downloads_down' => 'Больше всего скачиваний',
        'views_down' => 'Больше всего просмотров'
    ]
])