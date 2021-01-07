@extends('layouts.app', [
    'title' => 'Создание темы',
    'seo' => [
        'robots' => 'noindex'
    ]
])

@section('content')
<div class="content">
    <form id="forum-create-thread-form" method="post" action="{{ route('forum-thread-create') }}">
        <section class="section">
            <div class="section__title">Заголовок</div>
            <input type="text" name="title" placeholder="Заголовок" value="{{ old('title') }}" maxlength="80" autofocus autocapitalize="none" autocorrect="off" autocomplete="off" required>
        </section>
        <section class="section">
            <div class="section__title">Теги</div>
            <div class="tags">
                @include('components.tags', ['tags' => $tags])
            </div>
        </section>
        <section class="section">
            <div class="section__title">Содержание</div>
            <textarea id="ta" type="text" name="body" placeholder="Содержание" autocomplete="off" required data-type="rich">{{ old('body' )}}</textarea>
            {{-- <div class="editor">
                <div class="editor__toolbar" data-sticky>
                    <button data-command="bold"></button>
                    <button data-command="italic"></button>
                    <button data-command="strikethrough"></button>
                    <button data-command="underline"></button>
                    <button data-command="removeFormat"></button>
                    <button data-command="insertParagraph"></button>
                    <button data-command="insertImage"></button>
                    <button data-command="insertOrderedList"></button>
                    <button data-command="insertUnorderedList"></button>
                    <button data-command="justifyLeft"></button>
                    <button data-command="justifyCenter"></button>
                    <button data-command="justifyRight"></button>
                    <button data-command="indent"></button>
                    <button data-command="outdent"></button>
                </div>
                <div class="editor__content" name="body" dir="auto" contenteditable="true" spellcheck="true" required></div>
            </div> --}}
        </section>
        {{-- <div id="ta"></div> --}}
        
        @if ($errors->any())
            <p class="alert red small">{{ $errors->first() }}</p>
        @endif
    </form>
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        <button data-action="form-submit" data-target="#forum-create-thread-form" class="button primary">Создать</button>
    </div>
</aside>
@endsection

@section('header_scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@24.0.0/build/ckeditor.min.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.5/css/froala_editor.pkgd.min.css" integrity="sha256-bRPTxPBIuVV4QTNNf1gIkgEM+f0z3tjYdArJ0CN3JAg=" crossorigin="anonymous"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/froala-editor@3.2.5/js/froala_editor.min.js" integrity="sha256-pdJx4uTi3dJTrhCSTcAp9wxvwxHbyIN1zb34jSoqQi4=" crossorigin="anonymous"></script> --}}
@endsection

@section('footer_scripts')
{{-- <script>
    new FroalaEditor('#ta')
</script> --}}
    {{-- <script src="{{ asset('js/rte.js') }}"></script> --}}
    {{-- @include('scripts.ckeditor', ['target' => 'ta']) --}}
@endsection