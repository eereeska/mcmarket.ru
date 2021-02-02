<section class="section">
    <div class="section__header">
        <h2 class="section__title">Уведомления</h2>
        <a href="#read">Отметить все прочитанными</a>
        <a href="#delete">Удалить все</a>
    </div>
    <div class="section__content">
        @forelse ($notifications as $notification)
        <div class="data">
            <div class="data__icon icon icon--{{ $notification->data['icon'] ?? 'info' }}"></div>
            <div class="data__info">
                @if ($notification->type == 'admin-file-submit-request')
                <h3 class="data__value">Новая заявка на добавление <a href="{{ route('file-show', ['id' => $notification->data['file_id']]) }}" class="dashed">файла</a></h3>
                @endif
                <div class="data__desc">
                    <time datetime="{{ $notification->created_at->format('Y-m-d\TH:i:s.uP') }}">{{ $notification->created_at->ago() }}</time>
                    <div class="data__hidden data__hidden--hover">
                        <a href="#" class="dashed">Пометить прочитанным</a>
                        <a href="#" class="dashed">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="alert empty small">Уведомлений нет</p>
        @endforelse
    </div>
</section>