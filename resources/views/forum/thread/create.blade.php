@extends('layouts.app', [
    'title' => 'Создание темы'
])

@section('meta.robots')
<meta name="robots" content="noindex" />
@endsection

@section('content')
<div class="content">
    <form id="forum-create-thread-form" method="post" action="{{ route('forum-thread-create') }}">
        @csrf
        <section class="section">
            <h2 class="section__title">Заголовок</h2>
            <input type="text" name="title" placeholder="Заголовок" value="{{ old('title') }}" maxlength="80" autofocus autocapitalize="none" autocorrect="off" autocomplete="off" required>
        </section>
        <section class="section">
            <h2 class="section__title">Теги</h2>
            <div class="fluid fluid--wrap gap-1">
                @include('components._tags', ['tags' => $tags, 'class' => 'fluid'])
            </div>
        </section>
        <section class="section">
            <h2 class="section__title">Содержание</h2>
            <textarea id="ta" type="text" name="body" placeholder="Содержание" autocomplete="off" required data-type="rich">{{ old('body' )}}</textarea>
            {{-- <div class="editor">
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
{{-- <script src="{{ asset('js/ckeditor.min.js') }}"></script> --}}
@endsection

@section('footer_scripts')
{{-- <script>
    new FroalaEditor('#ta')
</script> --}}
    <script src="{{ asset('js/rte.js') }}"></script>
    {{-- @include('scripts.ckeditor', ['target' => 'ta']) --}}
@endsection