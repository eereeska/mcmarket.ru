@extends('layouts.app')

@section('meta.title', $group->name)

@if ($group->description)
@section('meta.description', substr(preg_replace('/\r|\n/', '', strip_tags($group->description)), 0, 80))
@endif

@section('meta.og:image', $group->getCover())

@section('content')
<div class="flex flex-wrap gap-x-10 gap-y-6 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full">
        <h1 class="mb-3 font-bold text-xl">{{ $group->name }}</h1>
        @if ($errors->any())
            <p class="mb-2 text-red-600">{{ $errors->first() }}</p>
        @endif
        @if ($group->description)
            <div class="space-y-3">{!! $group->description !!}</div>
        @endif
    </main>
    <aside class="w-full lg:w-1/3">
        <div class="sticky top-6">
            @include('groups.components._cover')
            <form action="{{ route('group.follow', ['slug' => $group->slug]) }}" method="post" class="mb-8">
                <button type="submit" class="bottom-3 w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Вступить</button>
            </form>
            <section class="mb-8">
                <h2 class="mb-4 text-gray-500">Владелец</h2>
                <a href="{{ route('user.show', ['name' => $group->owner->name]) }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                    <div class="w-12 h-12 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md" style="background-image: url({{ $group->owner->getAvatar() }})"></div>
                    <span>{{ $group->owner->name }}</span>
                </a>
            </section>
            <section class="mb-8">
                <a href="#" class="flex justify-between text-gray-500 hover:text-blue-500">
                    <h2 class="mb-4">Участники</h2>
                    <span class="text-gray-400">300</span>
                </a>
                <a href="{{ route('user.show', ['name' => $group->owner->name]) }}" class="flex flex-wrap items-center gap-x-3 gap-y-3 font-semibold hover:text-blue-500">
                    <div class="w-12 h-12 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md" style="background-image: url({{ $group->owner->getAvatar() }})"></div>
                    <span>{{ $group->owner->name }}</span>
                </a>
            </section>
            <section class="mb-8">
                <h2 class="mb-4 text-gray-500">Информация</h2>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-3">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="flex-grow">
                        <time datetime="{{ $group->created_at->toAtomString() }}" title="{{ $group->created_at->format('d.m.Y h:i:s') }}" class="font-semibold">{{ $group->created_at->ago() }}</time>
                        <div class="text-sm text-gray-500">Создано</div>
                    </div>
                </div>
            </section>
        </div>
    </aside>
</div>
@endsection