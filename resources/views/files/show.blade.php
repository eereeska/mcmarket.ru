@extends('layouts.app', [
    'page_classes' => 'file',
    'title' => $file->title
])

@section('content')
<div class="content">
    <section class="section">
        <div class="section__header">
            <ul class="breadcrumb">
                <li class="breadcrumb__item"><a href="#category">{{ $file->category ? $file->category->title : 'Без категории' }}</a></li>
                <li class="breadcrumb__item breadcrumb__item--active"><h1>{{ $file->short_title }}</h1></li>
            </ul>
            @if ($file->version)
            <span class="muted">{{ $file->version }}</span>
            @endif
        </div>
    </section>
    @if ($file->description)
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">Описание</h2>
        </div>
        <div class="section__content">
            {!! $file->description !!}
        </div>
    </section>
    @endif
</div>
<aside class="sidebar">
    <div class="sidebar__inner sidebar__inner--sticky">
        @if (auth()->check())
        @if (is_null($file->description) or $file->media_count < 1)
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Файл скрыт для других</h2>
            </div>
            <div class="section__content">
                @if (is_null($file->description))
                <p>Пожалуйста, заполните <span>Описание</span></p>
                @endif
                @if ($file->media_count < 1)
                <p>Пожалуйста, добавьте хотя бы одно изображение</p>
                @endif
            </div>
        </section>
        @endif
        <section class="section">
            <a href="{{ route('file-download', ['id' => $file->id]) }}" class="button green">Скачать</a>
        </section>
        @endif
        <section class="section">
            <div class="section__header">
                @if ($file->type === 'free')
                <h2 class="section__title">Автор</h2>
                @elseif ($file->type === 'paid')
                <h2 class="section__title">Продавец</h2>
                @elseif ($file->type === 'nulled')
                <h2 class="section__title">Поделился</h2>
                @endif
            </div>
            <div class="section__content">
                <div class="data">
                    @include('components._avatar', ['user' => $file->user])
                    <div class="data__info">
                        <h3 class="data__value"><a href="{{ route('user-show', ['name' => $file->user->name]) }}">{{ $file->user->name }}</a></h3>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="section">
            <h2 class="section__title">Ссылки</h2>
        </section> --}}
        <section class="section">
            <div class="section__header">
                <h2 class="section__title">Информация</h2>
            </div>
            <div class="section__content">
                <div class="data data_compact">
                    <div class="data__icon icon icon--eye"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->views }}</h3>
                        <div class="data__desc">@choice('Просмотр|Просмотра|Просмотров', $file->views)</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon--download"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->downloads }}</h3>
                        <div class="data__desc">@choice('Скачивание|Скачивания|Скачиваний', $file->downloads)</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon--file"></div>
                    <div class="data__info">
                        <h3 class="data__value">.{{ $file->extension }}</h3>
                        <div class="data__desc">Расширение</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon--weight-hanging"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->getSizeForHumans() }}</h3>
                        <div class="data__desc">Размер</div>
                    </div>
                </div>
                {{-- @if ($file->type != 'paid')
                <a href="https://www.virustotal.com/gui/file/{{ $file->vt_hash }}/detection" rel="nofollow" target="_blank" class="data data_compact">
                    <div class="data__icon icon icon--virus"></div>
                    <div class="data__info">
                        @if ($file->vt_status == 'completed')
                        <h3 class="data__value">{{ ($file->vt_stats['harmless'] + $file->vt_stats['malicious'] + $file->vt_stats['suspicious']) . '/' . ($file->vt_stats['undetected'] + $file->vt_stats['failure']) }}</h3>
                        @elseif ($file->vt_status  == 'queued')
                        <h3 class="data__value">В очереди на проверку</h3>
                        @elseif ($file->vt_status == 'in-progress')
                        <h3 class="data__value">Проверяется...</h3>
                        @else
                        <h3 class="data__value">Неизвестный статус</h3>
                        @endif
                        <div class="data__desc">VirusTotal</div>
                    </div>
                </a>
                @endif --}}
                <div class="data data_compact">
                    <div class="data__icon icon icon--sync-alt"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->updated_at->format('d.m.Y h:i:s') }}</h3>
                        <div class="data__desc">Обновлён</div>
                    </div>
                </div>
                <div class="data data_compact">
                    <div class="data__icon icon icon--clock"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $file->created_at->format('d.m.Y h:i:s') }}</h3>
                        <div class="data__desc">Загружен</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</aside>
@endsection