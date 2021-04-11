@extends('layouts.app')

@section('meta.title', 'Редактирование файла ' . $file->name)

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <ul class="breadcrumb">
                <li class="breadcrumb__item"><a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a></li>
                <li class="breadcrumb__item breadcrumb__item_active">Редактирование</li>
            </ul>
        </div>
        <div class="section__content">
            <form id="file-edit-form" method="post" action="{{ url()->current() }}" enctype="multipart/form-data">
                @csrf
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Категория</h2>
                    </div>
                    <div class="section__content">
                        @foreach ($categories as $category)
                        <label class="radio">
                            <input type="radio" name="category" value="{{ $category->name }}" class="radio__original" {{ $file->category->name == $category->name ? 'checked="checked"' : '' }}>
                            <span class="radio__mark"></span>
                            <span class="radio__label">{{ $category->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Заголовок</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="title" placeholder="Отображается в заголовке страницы и при выдаче в поиске" value="{{ $file->title }}" class="input" maxlength="60" autocapitalize="none" autocorrect="off" autocomplete="off" required>
                        <label for="title" class="label">Вы можете использовать «{v}» в качестве переменной, вместо которой будет подставлена актуальная версия файла, если она установлена. Например: {{ $file->title ?? 'Заголовок' }} {v} = {{ $file->title ?? 'Заголовок' }} {{ $file->version ?? '1.0.0' }}</label>
                        <label for="title" class="label">Также, вам доступны следующие переменные: «{p}» — будет заменена на стоимость файла</label>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Название</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="name" placeholder="Отображается на главной странице и в названии файла" value="{{ $file->name }}" class="input" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="off" required>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <div class="section__header-left">
                            <h2 class="section__title section__title_required">Тип</h2>
                        </div>
                    </div>
                    <div class="section__content">
                        <label class="radio">
                            <input type="radio" name="type" value="free" class="radio__original" {{ $file->type == 'free' ? 'checked="checked"' : '' }}>
                            <span class="radio__mark"></span>
                            <span class="radio__label">Бесплатный</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="type" value="paid" class="radio__original" {{ $file->type == 'paid' ? 'checked="checked"' : '' }} data-show-if-checked="price">
                            <span class="radio__mark"></span>
                            <span class="radio__label">Платный</span>
                        </label>
                        <div class="hidden" data-hidden-id="price">
                            <input type="number" name="price" placeholder="Введите стоимость в рублях..." value="{{ $file->price }}" class="input" min="1" autocorrect="off" autocomplete="off">
                            <label for="price" class="label">Обратите внимание, что комиссия сервиса составляет <span>{{ config('mcm.fee') }}%</span></label>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Обложка</h2>
                        <span class="muted">Рекомендуемый размер изображения: 300x300 пикселей</span>
                    </div>
                    <div class="section__content">
                        <label class="file">
                            <input type="file" name="cover" accept="image/*" value="{{ $file->cover_path }}" class="file__original">
                        </label>
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title section__title_required">Описание</h2>
                    </div>
                    <div class="section__content">
                        <div class="editor">
                            <div class="editor__toolbar" data-sticky>
                                <button data-command="bold"></button>
                                <button data-command="italic"></button>
                                <button data-command="strikethrough"></button>
                                <button data-command="underline"></button>
                                <button data-command="removeFormat"></button>
                                <button data-command="insertOrderedList"></button>
                                <button data-command="insertUnorderedList"></button>
                                <button data-command="justifyLeft"></button>
                                <button data-command="justifyCenter"></button>
                                <button data-command="justifyRight"></button>
                            </div>
                            <div class="editor__content" data-name="description" placeholder="Описание" dir="auto" contenteditable="true" spellcheck="true" required>{!! $file->description !!}</div>
                        </div>
                    </div>
                </section>
                {{-- <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Медиа</h2>
                    </div>
                    <div class="section__content">
                        @if ($file->media_count > 0)
                        @include('components.files._media', ['media' => $file->media])
                        @endif
                        <label class="file">
                            <input type="file" name="media-images[]" multiple accept="image/*" class="file__original" data-auto-upload="{{ route('file.media', ['id' => $file->id]) }}">
                            <span class="file__label">Нажмите здесь или перетащите изображения для загрузки</span>
                        </label>
                    </div>
                </section> --}}
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Версия</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="version" placeholder="1.0.0" value="{{ $file->version }}" class="input" autocorrect="off" autocomplete="off">
                    </div>
                </section>
                {{-- <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Собственная ссылка</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="custom_url" value="{{ $file->slug }}" placeholder="my-custom-url" autocorrect="off" autocomplete="off">
                    </div>
                </section>
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Ссылка для пожертвований</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="donation_url" value="{{ $file->donation_url }}" placeholder="paypal.me/mcmarket" autocorrect="off" autocomplete="off">
                    </div> --}}
                {{-- </section> --}}
                {{-- <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Название скачиваемого файла</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="name" placeholder="{{ $file->version ? $file->name . ' ' . $file->version : $file->name }}" autocomplete="no">
                    </div>
                </section> --}}
                <section class="section">
                    <div class="section__header">
                        <h2 class="section__title">Ключевые слова</h2>
                    </div>
                    <div class="section__content">
                        <input type="text" name="keywords" placeholder="Мой первый плагин, Бесплатно" value="{{ $file->keywords }}" class="input" autocomplete="off">
                    </div>
                </section>
            </form>
        </div>
    </section>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        {{-- @if ($file->cover_path)
        <section class="section">
            <a href="{{ route('file.show', ['id' => $file->id]) }}"><img class="cover" src="{{ asset('covers/' . $file->cover_path) }}"></img></a>
        </section>
        @endif --}}
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Действия</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.edit', ['id' => $file->id]) }}" class="data data_compact" data-submit="#file-edit-form">
                    <div class="data__icon icon icon_save"></div>
                    <div class="data__info">
                        <h3 class="data__value">Сохранить</h3>
                    </div>
                </a>
                <a href="{{ route('file.update.submit', ['id' => $file->id]) }}" class="data data_compact">
                    <div class="data__icon icon icon_upload"></div>
                    <div class="data__info">
                        <h3 class="data__value">Добавить обновление</h3>
                    </div>
                </a>
                @foreach ($errors->all() as $error)
                <p class="alert red small">{{ $error }}</p>
                @endforeach
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Опасная зона</h2>
            </div>
            <div class="section__content">
                <a href="{{ route('file.delete', ['id' => $file->id]) }}" data-request="delete" data-confirm="Вы уверены, что хотите удалить «{{ $file->name }}»" class="data data_compact">
                    <div class="data__icon icon icon_trash-alt"></div>
                    <div class="data__info">
                        <h3 class="data__value">Удалить файл</h3>
                    </div>
                </a>
            </div>
        </section>
    </div>
</aside>
@endsection