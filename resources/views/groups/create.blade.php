@extends('layouts.app', [
    'title' => 'Создание сообщества'
])

@section('meta.robots')
<meta name="robots" content="noindex" />
@endsection

@section('content')
<div class="content">
    <form id="group-create-form" method="post" action="{{ route('group-create') }}" enctype="multipart/form-data">
        @csrf
        <section class="section">
            <h2 class="section__title">Обложка</h2>
            <label class="file">
                <input type="file" name="cover" accept="image/*" class="file__original">
                <span class="file__label">Нажмите здесь или перетащите изображение для загрузки</span>
            </label>
        </section>
        <section class="section">
            <h2 class="section__title">Название</h2>
            <input type="text" name="name" placeholder="Уникальное название" value="{{ old('name') }}" maxlength="32" autofocus autocapitalize="none" autocorrect="off" autocomplete="off" required>
        </section>
        <section class="section">
            <h2 class="section__title">Описание</h2>
            <textarea id="ta" type="text" name="description" placeholder="Например, чем вы занимаетесь?" autocomplete="off" required data-type="rich">{{ old('description' )}}</textarea>
        </section>
        <section class="section">
            <h2 class="section__title">Тип</h2>
            <label class="radio">
                <input type="radio" name="type" value="public" class="radio__original" checked="checked">
                <span class="radio__mark"></span>
                <span class="radio__label">Публичное</span>
            </label>
            <label class="radio">
                <input type="radio" name="type" value="closed" class="radio__original">
                <span class="radio__mark"></span>
                <span class="radio__label">Закрытое</span>
            </label>
            <label class="radio">
                <input type="radio" name="type" value="private" class="radio__original">
                <span class="radio__mark"></span>
                <span class="radio__label">Приватное</span>
            </label>
        </section>
    </form>
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        {{-- @include('components._avatar', ['user' => null, 'id' => 'cover-preview', 'large' => true]) --}}
        @foreach ($errors->all() as $error)
        <p class="alert red small">{{ $error }}</p>
        @endforeach
        <button data-action="form-submit" data-target="#group-create-form" class="button primary">Создать</button>
    </div>
</aside>
@endsection