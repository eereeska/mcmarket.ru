@extends('layouts.admin')

@section('meta.title', $user->name)

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
                        <span class="file__label">Нажмите здесь или перетащите изображение для загрузки</span>
                    </label>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Никнейм</h2>
                </div>
                <div class="section__content">
                    <input type="text" name="name" value="{{ $user->name }}" class="input"></input>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Баланс</h2>
                </div>
                <div class="section__content">
                    <input type="number" name="balance" value="{{ $user->balance }}" class="input"></input>
                </div>
            </section>
            <section class="section">
                <div class="section__content">
                    <label class="toggle">
                        <div class="toggle__description">
                            <p>Подтверждён</p>
                        </div>
                        <input type="checkbox" value="1" class="toggle__checkbox" @if ($user->is_verified) checked @endif>
                        <span class="toggle__slider"></span>
                    </label>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Обо мне</h2>
                </div>
                <div class="section__content">
                    <textarea name="about" placeholder="{{ is_null($user->settings->about) ? 'Вы ещё ничего не рассказали о себе' : strip_tags($user->settings->about) }}" class="textarea textarea_small">{{ strip_tags($user->settings->about) }}</textarea>
                </div>
            </section>
            <section class="section">
                <div class="section__header">
                    <h2 class="section__title">Приватность</h2>
                </div>
                <div class="section__content">
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