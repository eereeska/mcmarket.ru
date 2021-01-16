@extends('layouts.app', [
    'title' => 'Настройки',
    'page_classes' => 'profile-settings'
])

@section('content')
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        <section class="section">
            @include('components._avatar', ['user' => $user, 'large' => true])
            <button class="button primary" data-action="form-submit" data-target="#settings-update-form">Сохранить</button>
        </section>
    </div>
</aside>
<div class="content">
    <section class="section">
        <form id="settings-update-form" action="{{ route('settings') }}" method="post">
            <section class="section">
                <h2 class="section__title">Аватар</h2>
                <label class="file-upload image drop">
                    <input type="file" name="avatar" accept="image/*" class="file-upload__original" data-file-upload="{{ route('upload-avatar') }}">
                    <span class="file-upload__label">Нажмите здесь или перетащите изображение для загрузки</span>
                </label>
            </section>
            <section class="section">
                <h2 class="section__title">Обо мне</h2>
                <textarea name="about" placeholder="{{ is_null($user->settings->about) ? 'Вы ещё ничего не рассказали о себе' : $user->settings->about }}">{{ $user->settings->about }}</textarea>
            </section>
            <section class="section">
                <h2 class="section__title">Приватность</h2>
                <label class="checkbox classic">
                    <input type="checkbox" name="is_search_engine_visible" value="1" {{ $user->settings->is_search_engine_visible ? 'checked' : '' }}>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Профиль можно найти в поиске Google, Яндекс и т.д.</span>
                </label>
                <label class="checkbox classic">
                    <input type="checkbox" name="is_online_status_visible" value="1" {{ $user->settings->is_online_status_visible ? 'checked' : '' }}>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Отображать Online статус</span>
                </label>
                <label class="checkbox classic">
                    <input type="checkbox" name="is_activity_visible" value="1" {{ $user->settings->is_activity_visible ? 'checked' : '' }}>
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Отображать последнюю активность</span>
                </label>
            </section>
        </form>
    </section>
</div>
@endsection