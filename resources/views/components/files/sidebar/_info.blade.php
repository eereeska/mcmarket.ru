@if ($file->type == 'paid')
<div class="data data_compact">
    <div class="data__icon icon icon--coin"></div>
    <div class="data__info">
        <h3 class="data__value">{{ $file->price }} @choice('рубль|рубля|рублей', $file->price)</h3>
        <div class="data__desc">Стоимость</div>
    </div>
</div>
@endif
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
    <div class="data__icon icon icon--clock"></div>
    <div class="data__info">
        <h3 class="data__value" {{ $file->version_updated_at->format('d.m.Y h:i:s') }}>{{ $file->created_at->ago() }}</h3>
        <div class="data__desc">Загружен</div>
    </div>
</div>
@if ($file->version_updated_at)
<div class="data data_compact">
    <div class="data__icon icon icon--sync-alt"></div>
    <div class="data__info">
        <h3 class="data__value" title="{{ $file->version_updated_at->format('d.m.Y h:i:s') }}">{{ $file->version_updated_at->ago() }}</h3>
        <div class="data__desc">Обновлён</div>
    </div>
</div>
@endif