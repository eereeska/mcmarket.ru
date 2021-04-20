@extends('layouts.app')

@section('meta.title', 'Сообщества')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full space-y-4">
        @each('groups.components._preview', $groups, 'group', 'components._empty')
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="mb-6">
            <label for="sort" class="block mb-3 text-gray-500">Сортировка</label>
            <select name="sort" class="w-full bg-white px-3 py-2 text-left cursor-default focus:ring-blue-300">
                <option value="updated">Последние обновления</option>
                <option value="new">Сначала новые</option>
                <option value="downloads">Самые скачиваемые</option>
                <option value="views">Самые просматриваемые</option>
            </select>
        </div>
        <div class="mb-6">
            <a href="{{ route('group.create') }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                    <i class="far fa-plus"></i>
                </div>
                <span>Создать сообщество</span>
            </a>
        </div>
    </aside>
</div>
@endsection