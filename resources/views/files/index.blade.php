@extends('layouts.app')

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Файлы</h2>
        </div>
        <div id="files" class="section__content list">
            @include('components.files._files', ['files' => $files])
        </div>
    </section>
</div>
<div class="sidebar">
    <section class="section section--sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Фильтры</h2>
            </div>
            <div class="section__content">
                <form action="{{ route('home') }}" data-on-submit="request" data-results="#files">
                    {{-- <section class="section section_compact">
                        <div class="select" data-submit-on-change>
                            <select name="sort" class="select__original">
                                <option value="update_down" selected>Последние обновления</option>
                                <option value="new_down">Новые</option>
                                <option value="downloads_down">Самые скачиваемые</option>
                                <option value="views_down">Самые просматриваемые</option>
                            </select>
                            <div class="select__trigger">
                                <label class="select__label">Сортировка</label>
                                <span class="select__selected">Последнее обновление</span>
                            </div>
                            <div class="select__options">
                                <span class="select__option select__option--selected" data-value="update_down">Последние обновления</span>
                                <span class="select__option" data-value="new_down">Новые</span>
                                <span class="select__option" data-value="downloads_down">Самые скачиваемые</span>
                                <span class="select__option" data-value="views_down">Самые просматриваемые</span>
                            </div>
                        </div>
                    </section>
                    <section class="section section_compact">
                        <div class="select" data-submit-on-change>
                            <select name="category" class="select__original">
                                @foreach ($categories as $category)
                                <option value="all" @if (!request()->category) selected @endif>Все</option>
                                <option value="{{ $category->name }}" @if (request()->category == $category->name) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <div class="select__trigger">
                                <label class="select__label">Категория</label>
                                @if (in_array(request()->category, $categories->pluck('name')->toArray()))
                                <span class="select__selected">{{ $categories->where('name', request()->category)->first()->title }}</span>
                                @else
                                <span class="select__selected">Не выбрана</span>
                                @endif
                            </div>
                            <div class="select__options">
                                <span class="select__option @if (!request()->category) select__option--selected @endif" data-value="all">Все</span>
                                @foreach ($categories as $category)
                                <span class="select__option @if (request()->category == $category->name) select__option--selected @endif" data-value="{{ $category->name }}">{{ $category->title }}</span>
                                @endforeach
                            </div>
                        </div>
                    </section> --}}
                    <label for="type" class="label">Категория</label>
                    <div class="select">
                        <input type="hidden" name="category" value="{{ request()->category }}" class="select__data" data-on-change="submit">
                        @if (in_array(request()->category, $categories->pluck('name')->toArray()))
                        <div class="select__selected">{{ $categories->where('name', request()->category)->first()->title }}</div>
                        @else
                        <div class="select__selected">Не выбрана</div>
                        @endif
                        <div class="select__options">
                            @foreach ($categories as $category)
                            <div class="select__option @if (request()->category == $category->name) select__option_selected @endif" data-value="{{ $category->name }}">{{ $category->title }}</div>
                            @endforeach
                        </div>
                    </div>
                    <label for="type" class="label">Тип</label>
                    <div class="select">
                        <input type="hidden" name="type" value="{{ request()->type }}" class="select__data" data-on-change="submit">
                        @if (request()->type == 'free')
                        <div class="select__selected">Бесплатные</div>
                        @elseif (request()->type == 'paid')
                        <div class="select__selected">Платные</div>
                        @elseif (request()->type == 'nulled')
                        <div class="select__selected">Nulled</div>
                        @else
                        <div class="select__selected">Все</div>
                        @endif
                        <div class="select__options">
                            <div class="select__option @if (!in_array(request()->type, ['free', 'paid', 'nulled'])) select__option_selected @endif" data-value="all">Все</div>
                            <div class="select__option @if (request()->type == 'free') select__option_selected @endif" data-value="free">Бесплатные</div>
                            <div class="select__option @if (request()->type == 'paid') select__option_selected @endif" data-value="paid">Платные</div>
                            <div class="select__option @if (request()->type == 'nulled') select__option_selected @endif" data-value="nulled">Nulled</div>
                        </div>
                    </div>
                    <label for="type" class="label">От пользователя</label>
                    <div class="select">
                        <input type="hidden" name="from" value="{{ request()->from }}" class="select__data" data-on-change="submit">
                        <input type="text" placeholder="Поиск..." class="input select__search" autocomplete="off" tabindex="0" minlength="2" data-url="{{ route('search.users') }}">
                        <div class="select__selected">Не указан</div>
                        <div class="select__options"></div>
                    </div>
                    {{-- <section class="section section_compact">
                        <div class="select select_with_search" data-submit-on-change>
                            <select name="type" class="select__original">
                                <option value="all" selected>Все</option>
                                <option value="free">Бесплатные</option>
                                <option value="paid">Платные</option>
                                <option value="nulled">Nulled</option>
                            </select>
                            <label class="select__label">От пользователя</label>
                            <div class="select__beauty">
                                <div class="select__selected">Не выбран</div>
                                <div class="select__search">
                                    <input type="text" name="user" placeholder="Поиск..." class="input" data-action="search" data-min-length="2" data-url="{{ route('search.users') }}" data-results=".select__options" data-has-loading-status>
                                </div>
                                <div class="select__options"></div>
                            </div>
                        </div>
                    </section> --}}
                </form>
            </div>
        </section>
        @auth
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Меню</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.submit', ['category' => request()->category ?? null]) }}" class="data data_compact">
                    <div class="data__icon icon icon--file-plus"></div>
                    <div class="data__info">
                        <h3 class="data__value">Добавить файл</h3>
                    </div>
                </a>
                <a href="{{ route('files.my') }}" class="data data_compact">
                    <div class="data__icon icon icon--file"></div>
                    <div class="data__info">
                        <h3 class="data__value">Мои файлы</h3>
                    </div>
                </a>
            </div>
        </section>
        @endauth
    </section>
</div>
@endsection