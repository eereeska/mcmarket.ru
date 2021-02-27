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
                <li class="breadcrumb__item breadcrumb__item_price">{{ $file->price }} @choice('рубль|рубля|рублей', $file->price)</li>
                @endif
            </ul>
        </h3>
        <div class="data__desc">
            <div class="data__hidden" data-on-hover="show">
                <label class="checkbox classic">
                    <input type="checkbox" name="is_visible" value="1" {{ $file->is_visible ? 'checked' : '' }} data-on-change="request" data-method="post" data-url="{{ route('admin.file.approve', ['id' => $file->id]) }}">
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Видимый</span>
                </label>
                <label class="checkbox classic">
                    <input type="checkbox" name="is_approved" value="1" {{ $file->is_approved ? 'checked' : '' }} data-on-change="request" data-method="post" data-url="{{ route('admin.file.approve', ['id' => $file->id]) }}">
                    <span class="checkbox__mark"></span>
                    <span class="checkbox__label">Одобрен</span>
                </label>
            </div>
            <div class="data__hidden" data-on-hover="hide">
                @include('components.files._meta')
            </div>
        </div>
    </div>
</div>