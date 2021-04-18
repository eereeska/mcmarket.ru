@extends('layouts.app')

@section('meta.title', 'Покупка ' . $file->name)
@section('meta.description', 'Покупка «' . $file->title . '»')

@if ($file->keywords)
@section('meta.keywords', $file->keywords)
@endif

@if ($file->cover_path)
@section('meta.og:image', asset('covers/' . $file->cover_path))
@endif

@section('content')
<div class="flex flex-wrap gap-x-10 gap-y-6 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full">
        <h1 class="mb-3 font-bold text-xl">{{ $file->title }}</h1>
        <ol class="flex flex-wrap mb-6 font-semibold text-gray-700">
            <li class="hover:text-blue-500">
                <a href="{{ route('home') }}">Файлы</a>
            </li>
            <li class="mx-2">
                <i class="far fa-angle-right"></i>
            </li>
            <li class="hover:text-blue-500">
                <a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a>
            </li>
            <li class="mx-2">
                <i class="far fa-angle-right"></i>
            </li>
            <li class="hover:text-blue-500">
                <a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a>
            </li>
            <li class="mx-2">
                <i class="far fa-angle-right"></i>
            </li>
            <li class="text-gray-500">
                <span>Покупка</span>
            </li>
        </ol>
        @if ($errors->any())
            <p class="mb-2 text-red-600">{{ $errors->first() }}</p>
        @endif
        <p>Обратите внимание, что администрация сайта не несёт ответственность за файлы, размещённые участниками сообщества, но вы можете разместить новый запрос в арбитраж, если приобретённый файл не будет соответствует описанию.</p>
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="sticky top-6">
            @include('files.components._cover')
            <section class="mb-8">
                <form action="{{ url()->current() }}" method="post">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-500 rounded-md px-6 py-4 font-semibold text-white text-center transition focus:outline-none focus:ring-2 focus:ring-indigo-400">Купить</button>
                </form>
            </section>
            <section class="mb-8">
                <h2 class="mb-4 text-gray-500">Автор</h2>
                <a href="{{ route('user.show', ['name' => $file->user->name]) }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                    <div class="w-12 h-12 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md" style="background-image: url({{ $file->user->getAvatar() }})"></div>
                    <span>{{ $file->user->name }}</span>
                </a>
            </section>
            <section class="space-y-3 mb-6">
                <h2 class="mb-4 text-gray-500">Информация</h2>
                @if ($file->price)
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                            <i class="far fa-ruble-sign"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold">{{ number_format($file->price, 0, ' ', ' ') }} руб</div>
                            <div class="text-sm text-gray-500">Стоимость</div>
                        </div>
                    </div>
                @endif
                @if ($file->version)
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                            <i class="far fa-hashtag"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold">{{ $file->version }}</div>
                            <div class="text-sm text-gray-500">Версия</div>
                        </div>
                    </div>
                @endif
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="font-semibold">{{ $file->extension }}</div>
                        <div class="text-sm text-gray-500">Расширение</div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-weight-hanging"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="font-semibold">{{ $file->getSizeForHumans() }}</div>
                        <div class="text-sm text-gray-500">Размер</div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="flex-grow">
                        <time datetime="{{ $file->created_at->toAtomString() }}" title="{{ $file->created_at->format('d.m.Y h:i:s') }}" class="font-semibold">{{ $file->created_at->ago() }}</time>
                        <div class="text-sm text-gray-500">Добавлен</div>
                    </div>
                </div>
                @if ($file->version_updated_at != $file->created_at)
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                            <i class="far fa-history"></i>
                        </div>
                        <div class="flex-grow">
                            <time datetime="{{ $file->version_updated_at->toAtomString() }}" title="{{ $file->version_updated_at->format('d.m.Y h:i:s') }}" class="font-semibold">{{ $file->version_updated_at->ago() }}</time>
                            <div class="text-sm text-gray-500">Обновлён</div>
                        </div>
                    </div>
                @endif
            </section>
            <section class="space-y-3">
                <h2 class="mb-4 text-gray-500">Статистика</h2>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-eye"></i>
                    </div>
                    <div class="flex flex-wrap gap-x-1 gap-y-1">
                        <span class="font-semibold">{{ number_format($file->views_count, 0, ' ', ' ') }}</span>
                        <span class="text-gray-600">@choice('просмотр|просмотра|просмотров', $file->views_count)</span>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-download"></i>
                    </div>
                    <div class="flex flex-wrap gap-x-1 gap-y-1">
                        <span class="font-semibold">{{ number_format($file->downloads_count, 0, ' ', ' ') }}</span>
                        <span class="text-gray-600">@choice('скачивание|скачивания|скачиваний', $file->downloads_count)</span>
                    </div>
                </div>
            </section>
        </div>
    </aside>
</div>
@endsection