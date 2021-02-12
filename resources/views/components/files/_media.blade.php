<ul class="media">
    @foreach ($media as $item)
    <li class="media__item">
        <div class="media__image" style="background-image: url({{ asset('media/' . $item->name) }})"></div>
        <a href="#insert-media" class="media__action" data-action="insert-text" data-target="textarea[name='description']" data-value="[media={{ asset('media/' . $item->name) }}]">Вставить</a>
        <a href="{{ route('file-media-delete', ['file' => $item->file, 'media' => $item]) }}" class="media__action" data-action="request" data-method="post">Удалить</a>
    </li>
    @endforeach
</ul>