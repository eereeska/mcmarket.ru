<div class="data data_compact">
    @if ($file->cover_path)
    <a href="{{ route('file.show', ['id' => $file->id]) }}" class="data__icon cover" style="background-image: url({{ asset('covers/' . $file->cover_path) }})"></a>
    @else
    <a href="{{ route('file.show', ['id' => $file->id]) }}" class="data__icon icon"></a>
    @endif
    <div class="data__info">
        <h3 class="data__value">
            <ul class="breadcrumb">
                @if (request()->category != $file->category->name)
                <li class="breadcrumb__item"><a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a></li>
                @endif
                <li class="breadcrumb__item breadcrumb__item--active"><a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a></li>
                @if ($file->type == 'paid' and $file->price)
                <li class="breadcrumb__item breadcrumb__item_price">{{ $file->price . ' ' . trans_choice('рубль|рубля|рублей', $file->price) }}</li>
                @endif
            </ul>
        </h3>
        <div class="data__desc">
            <ul class="meta">
                @if (!$file->is_visible and !$file->is_approved)
                <li class="meta__item">Скрыт</li>
                @elseif (!$file->is_approved)
                <li class="meta__item">На рассмотрении</li>
                @else
                <li class="meta__item"><a href="{{ route('user.show', ['user' => $file->user]) }}">{{ $file->user->name }}</a></li>
                <li class="meta__item"><time>{{ $file->created_at->ago() }}</time></li>
                <li class="meta__item"><span>{{ $file->downloads_count }} @choice('скачивание|скачивания|скачиваний', $file->downloads_count)</span></li>
                <li class="meta__item"><span>{{ $file->views_count }} @choice('просмотр|просмотра|просмотров', $file->views_count)</span></li>
                @endif
            </ul>
        </div>
    </div>
</div>