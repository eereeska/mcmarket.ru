@extends('layouts.app')

@section('meta.title', 'Добавление файла')
@section('meta.robots', 'noindex')

@section('content')
<div class="content">
    <form id="file-submit-form" method="post" action="{{ route('file.submit') }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title_required">Категория</h2>
            </div>
            <div class="section__content">
                @foreach ($categories as $category)
                <label class="radio">
                    @if (old('category') == $category->name)
                    <input type="radio" name="category" value="{{ $category->name }}" class="radio__original" checked>
                    @else
                    <input type="radio" name="category" value="{{ $category->name }}" class="radio__original">
                    @endif
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
                <input type="text" name="title" placeholder="Отображается в поиске Google, Яндекс и т.д." value="{{ old('title') }}" maxlength="60" autocapitalize="none" autocorrect="off" autocomplete="off" required class="input">
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title_required">Название</h2>
            </div>
            <div class="section__content">
                <input type="text" name="name" placeholder="Отображается на главной странице и в названии файла" value="{{ old('name') }}" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="off" required class="input">
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <div class="section__header-left">
                    <h2 class="section__title section__title_required">Тип</h2>
                    {{-- <p class="section__description">Бесплатные и Nulled файлы автоматически отправляются на проверку в <a href="https://www.virustotal.com" rel="nofollow" target="_blank" class="dashed">VirusTotal</a></p> --}}
                </div>
            </div>
            <div class="section__content">
                <label class="radio">
                    <input type="radio" name="type" value="free" class="radio__original">
                    <span class="radio__mark"></span>
                    <span class="radio__label">Бесплатный</span>
                </label>
                <label class="radio">
                    <input type="radio" name="type" value="nulled" class="radio__original">
                    <span class="radio__mark"></span>
                    <span class="radio__label">Nulled</span>
                </label>
                <label class="radio">
                    <input type="radio" name="type" value="paid" class="radio__original" data-show-if-checked="price">
                    <span class="radio__mark"></span>
                    <span class="radio__label">Платный</span>
                </label>
                <div class="hidden" data-hidden-id="price">
                    <input type="number" name="price" placeholder="Введите стоимость в рублях..." value="{{ old('price') }}" class="input" min="1" autocorrect="off" autocomplete="off">
                    <p>Обратите внимание, что комиссия сервиса составляет <span>{{ config('mcm.fee') }}%</span></p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title_required">Файл</h2>
            </div>
            <div class="section__content">
                <label class="file">
                    <input type="file" name="file" class="file__original">
                    <span class="file__label">Нажмите здесь или перетащите файл</span>
                </label>
            </div>
        </section>
        {{-- <section class="section">
            <div class="section__header">
                <h2 class="section__title">Комментарий для администрации</h2>
            </div>
            <div class="section__content">
                <textarea name="comment" placeholder="">{{ old('comment') }}</textarea>
            </div>
        </section> --}}
        {{-- <section class="section">
            <h2 class="section__title section__title_required">Обложка</h2>
            <label class="file">
                <input type="file" name="cover" accept="image/*" class="file__original">
                <span class="file__label">Нажмите здесь или перетащите изображение</span>
            </label>
        </section>
        <section class="section">
            <h2 class="section__title">Изображения</h2>
            <label class="file">
                <input type="file" name="images" accept="image/*">
                <span class="file__label">Нажмите здесь или перетащите изображения для загрузки</span>
            </label>
        </section>
        <section class="section">
            <h2 class="section__title">Версия</h2>
            <input type="text" name="version" placeholder="1.0.0" autocorrect="off" autocomplete="off">
        </section> --}}
        {{-- <section class="section">
            <h2 class="section__title">Собственная ссылка</h2>
            <input type="text" name="custom-url" placeholder="my-custom-url" autocorrect="off" autocomplete="off">
        </section> --}}
        {{-- <section class="section">
            <h2 class="section__title">Ссылка для пожертвований</h2>
            <input type="text" name="donation-url" placeholder="paypal.me/mcmarket" autocorrect="off" autocomplete="off">
        </section> --}}
        {{-- <section class="section">
            <h2 class="section__title">Ключевые слова</h2>
            <input type="text" name="keywords" placeholder="Мой первый плагин, Бесплатно" autocomplete="off">
        </section> --}}
    </form>
</div>
<aside class="sidebar">
    <section class="section section_sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Шаг 1/2</h2>
            </div>
            <div class="section__content">
                <p>После внесения всей необходимой информации, администрация вручную проверит сам файл и его описание на соответствие с <a href="{{ route('terms') }}" class="dashed" target="_blank">правилам сообщества</a></p>
            </div>
        </section>
        <section class="section">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button class="button primary" data-submit="#file-submit-form">Отправить на проверку</button>
        </section>
    </section>
</aside>
@endsection