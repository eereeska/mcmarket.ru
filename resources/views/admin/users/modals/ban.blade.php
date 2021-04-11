<div class="modal" data-modal="{{ $id ?? 'none' }}">
    <div class="modal__body">
        <div class="modal__header">
            <div class="modal__title">Блокировка {{ $user->name }}</div>
        </div>
        <div class="modal__content">
            <section class="section section_compact">
                <input type="datetime-local" name="expiration_date" value="{{ now()->addHour() }}">
            </section>
            <section class="section section_compact">
                <textarea class="textarea textarea_small" name="reason" placeholder="Причина"></textarea>
            </section>
        </div>
        <div class="modal__footer">
            <button class="button primary">Заблокировать</button>
        </div>
    </div>
</div>