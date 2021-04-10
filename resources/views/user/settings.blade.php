@extends('layouts.app')

@section('meta.title', 'Настройки')

@section('content')
<aside class="sidebar">
    <section class="section section_sticky">
        <div class="section__header">
            @include('components._avatar', ['user' => $user, 'large' => true, 'id' => 'avatar-preview'])
        </div>
        <div class="section__content">
            @foreach ($errors->all() as $error)
            <p class="alert red small">{{ $error }}</p>
            @endforeach
            <button class="button primary" data-action="form-submit" data-target="#settings-update-form">Сохранить</button>
        </div>
    </section>
</aside>
<div class="content">
    <section class="section">
        <form id="settings-update-form" action="{{ route('settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Аватар</h2>
                </div>
                <div class="section__content">
                    <label class="file">
                        <input type="file" name="avatar" accept="image/*" class="file__original" value="{{ $user->avatar }}">
                    </label>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Обо мне</h2>
                </div>
                <div class="section__content">
                    <textarea name="about" placeholder="{{ is_null($user->settings->about) ? 'Вы ещё ничего не рассказали о себе' : strip_tags($user->settings->about) }}" class="textarea">{{ strip_tags($user->settings->about) }}</textarea>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Приватность</h2>
                </div>
                <div class="section__content">
                    <section class="section section_small">
                        <label class="checkbox classic">
                            <input type="checkbox" name="is_search_engine_visible" value="1" {{ $user->settings->is_search_engine_visible ? 'checked' : '' }}>
                            <span class="checkbox__mark"></span>
                            <span class="checkbox__label">Профиль можно найти в поиске Google, Яндекс и т.д.</span>
                        </label>
                    </section>
                    <section class="section section_small">
                        <label class="checkbox classic">
                            <input type="checkbox" name="is_online_status_visible" value="1" {{ $user->settings->is_online_status_visible ? 'checked' : '' }}>
                            <span class="checkbox__mark"></span>
                            <span class="checkbox__label">Отображать Online статус</span>
                        </label>
                    </section>
                    {{-- <label class="checkbox classic">
                        <input type="checkbox" name="is_groups_visible" value="1" {{ $user->settings->is_groups_visible ? 'checked' : '' }}>
                        <span class="checkbox__mark"></span>
                        <span class="checkbox__label">Отображать сообщества</span>
                    </label> --}}
                </div>
            </section>
        </form>
    </section>
</div>
@endsection