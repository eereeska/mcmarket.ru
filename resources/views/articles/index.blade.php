@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
        <main class="w-full">
            @each('articles.components._preview', $articles, 'article', 'components._empty')
        </main>
        <aside class="w-full lg:w-1/3">
            <div class="sticky top-6">
                <a href="#" class="flex flex-wrap items-center gap-x-3 gap-y-3 mb-4 font-semibold hover:text-blue-500">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-md">
                        <i class="far fa-upload"></i>
                    </div>
                    <span>Новости сайта</span>
                </a>
            </div>
        </aside>
    </div>
@endsection