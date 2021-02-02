@extends('layouts.app', [
    'title' => 'Добавление файла'
])

@section('meta.robots')
<meta name="robots" content="noindex" />
@endsection

@section('content')
<div class="content">
    <form id="files-submit-form" method="post" action="{{ route('files-submit') }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Категория</h2>
            </div>
            <div class="section__content">
                @foreach ($categories as $category)
                <label class="radio">
                    <input type="radio" name="category" value="{{ $category->name }}" class="radio__original">
                    <span class="radio__mark"></span>
                    <span class="radio__label">{{ $category->title }}</span>
                </label>
                @endforeach
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Заголовок</h2>
            </div>
            <div class="section__content">
                <input type="text" name="title" placeholder="Отображается в заголовке страницы и в поиске" value="{{ old('title') }}" maxlength="60" autocapitalize="none" autocorrect="off" autocomplete="off" required>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Короткий заголовок (название)</h2>
            </div>
            <div class="section__content">
                <input type="text" name="short_title" placeholder="Отображается на главной странице, в названии файла" value="{{ old('short_title') }}" maxlength="20" autocapitalize="none" autocorrect="off" autocomplete="off" required>
            </div>
        </section>
        {{-- <section class="section">
            <h2 class="section__title section__title--required">Описание</h2>
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
                    <button data-command="superscript"></button>
                    <button data-command="subscript"></button>
                </div>
                <div class="editor__content" name="body" placeholder="Содержание" dir="auto" contenteditable="true" spellcheck="true" required></div>
            </div>
        </section> --}}
        <section class="section">
            <div class="section__header">
                <div class="section__header-left">
                    <h2 class="section__title section__title--required">Тип</h2>
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
                    <input type="radio" name="type" value="paid" class="radio__original">
                    <span class="radio__mark"></span>
                    <span class="radio__label">Платный</span>
                </label>
                <div class="hidden" data-show-if="radio-checked" data-target-name="type" data-target-value="paid">
                    <input type="number" name="price" placeholder="Введите стоимость в рублях..." value="{{ old('price') }}" min="1" autocorrect="off" autocomplete="off">
                    <p>Обратите внимание, что комиссия сервиса составляет <span>{{ config('mcm.fee') }}%</span></p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title section__title--required">Файл</h2>
            </div>
            <div class="section__content">
                <label class="file">
                    <input type="file" name="file" class="file__original">
                    <span class="file__label">Нажмите здесь или перетащите файл</span>
                </label>
            </div>
        </section>
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Комментарий для администрации</h2>
            </div>
            <div class="section__content">
                <textarea name="comment" placeholder="">{{ old('comment') }}</textarea>
            </div>
        </section>
        {{-- <section class="section">
            <h2 class="section__title section__title--required">Обложка</h2>
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
    <div class="sidebar__inner sidebar__inner--sticky">
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Полезная информация</h2>
            </div>
            <div class="section__content">
                <p>После внесения необходимой информации, файл и сама информация будет проверена администрацией на соответствие <a href="{{ route('terms') }}" class="dashed" target="_blank">правилам сообщества</a></p>
                <p>При одобрении заявки, вы получите соответствующее уведомление, а файл моментально появится в общем списке файлов на сайте</p>
            </div>
        </section>
        <section class="section">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button data-action="form-submit" data-target="#files-submit-form" class="button primary">Отправить на проверку</button>
        </section>
    </div>
</aside>
@endsection