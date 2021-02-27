@include('components._select', [
    'label' => 'Категория',
    'name' => 'category',
    'submit' => true,
    'reset' => true,
    'default' => 'Не выбрана',
    'selected' => request()->get('category', 'none'),
    'options' => $categories->pluck('title', 'name')->toArray()
])