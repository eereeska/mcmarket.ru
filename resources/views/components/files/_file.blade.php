<div class="data data_compact">
    @if ($file->cover_path)
    <a href="{{ route('file.show', ['id' => $file->id]) }}" class="data__icon cover" style="background-image: url({{ $file->getCover() }})"></a>
    @else
    <a href="{{ route('file.show', ['id' => $file->id]) }}" class="data__icon icon"></a>
    @endif
    <div class="data__info">
        <h3 class="data__value">
            <ul class="breadcrumb">
                @if (request()->category != $file->category->name)
                <li class="breadcrumb__item"><a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a></li>
                @endif
                <li class="breadcrumb__item breadcrumb__item_active"><a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a></li>
                @if ($file->type == 'paid' and $file->price)
                <li class="breadcrumb__item breadcrumb__item_price">{{ $file->price }} @choice('рубль|рубля|рублей', $file->price)</li>
                @endif
            </ul>
        </h3>
        <div class="data__desc">
            @include('components.files._meta')
        </div>
    </div>
</div>