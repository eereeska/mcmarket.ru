@extends('layouts.app')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <aside class="w-full lg:w-1/3">
        <div class="mb-6">
            <label for="sort" class="block mb-3 text-gray-500">Сортировка</label>
            <select name="sort" class="w-full px-3 py-2">
                <option value="updated">Последние обновления</option>
                <option value="new">Сначала новые</option>
                <option value="downloads">Самые скачиваемые</option>
                <option value="views">Самые просматриваемые</option>
            </select>
        </div>
    </aside>
    <main class="w-full space-y-4">
        Аккаунты
    </main>
</div>
@endsection