@extends('layouts.app')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
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
            <label for="sort" class="block mb-3 text-gray-500">Категория</label>
            <select name="sort" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left cursor-default focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </aside>
    <main class="w-full space-y-4">
        @each('files.components._preview', $files, 'file', 'components._empty')
    </main>
</div>
{{-- <aside class="sidebar">
    <div class="mb-6"></div>
</aside>
<div class="content">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Файлы</h2>
        </div>
        <div id="files" class="section__content list">
            @include('components.files._files', ['files' => $files])
        </div>
    </section>
</div> --}}
@endsection