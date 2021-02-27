<ul class="meta">
    @if (!$file->is_visible and !$file->is_approved)
    <li class="meta__item">Скрыт</li>
    @elseif (!$file->is_approved)
    <li class="meta__item">На рассмотрении</li>
    @else
    <li class="meta__item"><a href="{{ route('user.show', ['user' => $file->user]) }}">{{ $file->user->name }}</a></li>
    <li class="meta__item"><time datetime="{{ $file->created_at->toAtomString() }}" title="{{ $file->created_at->format('d.m.Y h:i:s') }}">{{ $file->created_at->ago() }}</time></li>
    <li class="meta__item"><span>{{ $file->downloads_count }} @choice('скачивание|скачивания|скачиваний', $file->downloads_count)</span></li>
    <li class="meta__item"><span>{{ $file->views_count }} @choice('просмотр|просмотра|просмотров', $file->views_count)</span></li>
    @endif
</ul>