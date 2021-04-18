@extends('layouts.app')

@section('meta.title', $file->title)

@if ($file->description)
@section('meta.description', $file->getHeadMetaDescription())
@endif

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
            <li class="text-gray-500">
                <span>{{ $file->name }}</span>
            </li>
        </ol>
        @if ($errors->any())
            <p class="mb-2 text-red-600">{{ $errors->first() }}</p>
        @endif
        @if ($file->description)
            <article class="space-y-3">{!! $file->description !!}</article>
        @elseif (auth()->id() == $file->user_id)
            <a href="{{ route('file.edit', ['id' => $file->id, '#description']) }}" class="block bg-gray-200 rounded-md px-2 py-2 font-semibold text-center hover:text-blue-500">Заполните описание</a>
        @else
            <span class="block bg-gray-200 rounded-md px-2 py-2 font-semibold text-center">Описание отсутствует</span>
        @endif
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="sticky top-6">
            @include('files.components._cover')
            <section class="mb-8">
                @if ($file->price or auth()->guest() or auth()->id() != $file->user_id and !auth()->user()->hasPurchasedFile($file))
                    <a href="{{ route('file.purchase', ['id' => $file->id]) }}" class="block bg-indigo-500 rounded-md px-6 py-4 font-semibold text-white text-center transition focus:outline-none focus:ring-2 focus:ring-indigo-400">Купить</a>
                @else
                    <a href="{{ route('file.download', ['id' => $file->id]) }}" target="_blank" class="block bg-green-600 rounded-md px-6 py-4 font-semibold text-white text-center transition focus:outline-none focus:ring-2 focus:ring-green-500">Скачать</a>
                @endif
                @if (auth()->id() == $file->user_id)
                    <a href="{{ route('file.edit', ['id' => $file->id]) }}" class="block rounded-md mt-3 px-3 py-2 font-semibold text-center transition hover:bg-blue-100 hover:text-blue-500 focus:outline-none focus:bg-blue-100">Редактировать</a>
                @endif
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
                @if ($file->price)
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                            <i class="far fa-cash-register"></i>
                        </div>
                        <div class="flex flex-wrap gap-x-1 gap-y-1">
                            <span class="font-semibold">{{ number_format($file->purchases_count, 0, ' ', ' ') }}</span>
                            <span class="text-gray-600">@choice('покупка|покупки|покупок', $file->purchases_count)</span>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </aside>
</div>
{{-- <div class="content">
    <section class="section section_sticky">
        @auth
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                @if ($file->type == 'paid' and auth()->user()->id != $file->user_id and !auth()->user()->hasPurchasedFile($file))
                <a href="{{ route('file.purchase', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon_cart"></div>
                    <div class="data__info">
                        <h3 class="data__value">Купить</h3>
                    </div>
                </a>
                @else
                <a href="{{ route('file.download', ['id' => $file->id]) }}" target="_blank" class="data data_compact">
                    <div class="data__icon icon icon_download"></div>
                    <div class="data__info">
                        <h3 class="data__value">Скачать</h3>
                    </div>
                </a>
                @endif
                @if ($file->user_id == auth()->user()->id)
                <a href="{{ route('file.edit', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon_edit"></div>
                    <div class="data__info">
                        <h3 class="data__value">Редактировать</h3>
                    </div>
                </a>
                @else
                <a href="#" class="data data_compact">
                    <div class="data__icon icon icon_report"></div>
                    <div class="data__info">
                        <h3 class="data__value">Пожаловаться</h3>
                    </div>
                </a>
                @endif
            </div>
        </section>
        @endauth
        <section class="section">
            <div class="section__header">
                @if ($file->type === 'paid')
                <h2 class="section__title">Продавец</h2>
                @else
                <h2 class="section__title">Автор</h2>
                @endif
            </div>
            <div class="section__content">
                <a href="{{ route('user.show', ['user' => $file->user]) }}" class="data">
                    <div class="data__icon avatar" style="background-image: url({{ $file->user->getAvatar() }})"></div>
                    <div class="data__info">
                        <h3 class="data__value sidebar_trim_with_icon">{{ $file->user->name }}</h3>
                    </div>
                </a>
            </div>
        </section>
        @if ($file->donation_url)
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Ссылки</h2>
            </div>
            <div class="section__content">
                <a href="{{ $file->donation_url }}" class="data data_compact">
                    <div class="data__icon icon icon_coin"></div>
                    <div class="data__info">
                        <h3 class="data__value">Поддержать автора</h3>
                    </div>
                </a>
            </div>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Информация</h2>
            </div>
            <div class="section__content">
                @include('components.files.sidebar._info', ['file' => $file])
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Статистика</h2>
            </div>
            <div class="section__content">
                <div class="data data_compact">
                    <div class="data__icon icon icon_eye"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ number_format($file->views_count, 0, ' ', ' ') }}</h3>
                        <div class="data__desc">@choice('Просмотр|Просмотра|Просмотров', $file->views_count)</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon_download"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ number_format($file->downloads_count, 0, ' ', ' ') }}</h3>
                        <div class="data__desc">@choice('Скачивание|Скачивания|Скачиваний', $file->downloads_count)</div>
                    </div>
                </div>
                @if ($file->type == 'paid')
                <div class="data data_compact">
                    <div class="data__icon icon icon_cart"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->purchases_count }}</h3>
                        <div class="data__desc">@choice('Покупка|Покупки|Покупок', $file->purchases_count)</div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </section>
</aside> --}}
@endsection