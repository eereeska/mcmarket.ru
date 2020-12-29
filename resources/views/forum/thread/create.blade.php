@extends('layouts.app')

@section('content')
<form id="form" method="post" action="{{ route('forum-thread-create') }}">
    {{ csrf_field() }}
    <div class="section_title">
        <h4>Заголовок</h4>
    </div>
    <input type="text" name="title" placeholder="Заголовок" value="{{ old('title') }}" maxlength="80" autofocus autocapitalize="none" autocorrect="off" autocomplete="off" required>
    <div class="section_title">
        <h4>Теги</h4>
    </div>
    <div class="tags">
        <a href="#" class="tag discussions">Обсуждения</a>
        <a href="#" class="tag ideas">Идеи</a>
        <a href="#" class="tag plugins">Плагины</a>
        <a href="#" class="tag graphics">Графика</a>
        <a href="#" class="tag buildings">Строительство</a>
        <a href="#" class="tag accounts">Аккаунты</a>
        <a href="#" class="tag news">Новости</a>
        <a href="#" class="tag giveaways">Розыгрыши</a>
        <a href="#" class="tag buying">Покупка</a>
        <a href="#" class="tag selling">Продажа</a>
    </div>
    <textarea id="ta" type="text" name="body" placeholder="Содержание" autocomplete="off" required data-type="rich">{{ old('body' )}}</textarea>
    {{-- <div id="ta" class="rich-editor"></div> --}}
    {{-- <div class="rich-editor">
        <div class="rich-editor__toolbar">
            <div class="bold" data-action="bold"></div>
            <div class="italic" data-action="italic"></div>
            <div class="strikethrough" data-action="strikethrough"></div>
            <div class="underline" data-action="underline"></div>
        </div>
        <div class="rich-editor__content" contenteditable="true"></div>
    </div> --}}
    @if ($errors->any())
        <p class="alert red small">{{ $errors->first() }}</p>
    @endif
</form>
@endsection

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        <button onclick="editor.save()
        .then((savedData) => {
          console.log(savedData);
        });" data-target="#form" class="button primary">Создать</button>
    </div>
</aside>
@endsection

@section('header_scripts')
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@24.0.0/build/ckeditor.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script><!-- List -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->

<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script> --}}
@endsection

@section('footer_scripts')
    {{-- <script src="{{ asset('js/rte.js') }}"></script> --}}
    @include('scripts.ckeditor', ['target' => 'ta'])
    {{-- @include('scripts.editorjs', ['target' => 'ta']) --}}
@endsection