<div class="data data_compact">
    @if ($file->cover_path)
    <div class="data__icon cover" style="background-image: url({{ asset('covers/' . $file->cover_path) }})"></div>
    @else
    <div class="data__icon icon icon--layers"></div>
    @endif
    <div class="data__info">
        @if (request()->input('category') == $file->category->name)
        <h3 class="data__value"><a href="{{ route('file.show', ['file' => $file]) }}">{{ $file->short_title }}</a></h3>
        @else
        <h3 class="data__value">
            <ul class="breadcrumb">
                <li class="breadcrumb__item"><a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a></li>
                <li class="breadcrumb__item breadcrumb__item--active"><a href="{{ route('file.show', ['file' => $file]) }}">{{ $file->short_title }}</a></li>
            </ul>
        </h3>
        @endif
        <div class="data__desc">
            <ul class="meta">
                <li class="meta__item"><a href="{{ route('user.show', ['user' => $file->user]) }}">{{ $file->user->name }}</a></li>
                <li class="meta__item"><time>{{ $file->created_at->ago() }}</time></li>
                <li class="meta__item"><span>{{ $file->downloads_count }} @choice('скачивание|скачивания|скачиваний', $file->downloads_count)</span></li>
                <li class="meta__item"><span>{{ $file->views_count }} @choice('просмотр|просмотра|просмотров', $file->views_count)</span></li>
            </ul>
        </div>
    </div>
</div>