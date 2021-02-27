<form action="{{ route('home') }}" data-on-submit="request" data-results="#files">
    @if ($sort)
    <label for="sort" class="label">Сортировка</label>
    <div class="select">
        <input type="hidden" name="sort" class="select__data" data-on-change="submit">
        <div class="select__selected">Не выбрана</div>
        <div class="select__options">
            <div class="select__option" data-value="update_down">Последние обновления</div>
            <div class="select__option" data-value="new_down">Новые</div>
            <div class="select__option" data-value="downloads_down">Самые скачиваемые</div>
            <div class="select__option" data-value="views_down">Самые просматриваемые</div>
        </div>
    </div>
    @endif
    @if ($categories)
    <label for="category" class="label">Категория</label>
    <div class="select">
        <input type="hidden" name="category" value="{{ request()->category }}" class="select__data" data-on-change="submit">
        @if (in_array(request()->category, $categories->pluck('name')->toArray()))
        <div class="select__selected">{{ $categories->where('name', request()->category)->first()->title }}</div>
        @else
        <div class="select__selected">Не выбрана</div>
        @endif
        <div class="select__options">
            <div class="select__option @if (!in_array(request()->category, $categories->pluck('name')->toArray())) select__option_selected @endif" data-value="none">Не выбрана</div>
            @foreach ($categories as $category)
            <div class="select__option @if (request()->category == $category->name) select__option_selected @endif" data-value="{{ $category->name }}">{{ $category->title }}</div>
            @endforeach
        </div>
    </div>
    @endif
    @if ($type)
    <label for="type" class="label">Тип</label>
    <div class="select">
        <input type="hidden" name="type" value="{{ request()->type }}" class="select__data" data-on-change="submit">
        @if (request()->type == 'free')
        <div class="select__selected">Бесплатные</div>
        @elseif (request()->type == 'paid')
        <div class="select__selected">Платные</div>
        @elseif (request()->type == 'nulled')
        <div class="select__selected">Nulled</div>
        @else
        <div class="select__selected">Все</div>
        @endif
        <div class="select__options">
            <div class="select__option @if (!in_array(request()->type, ['free', 'paid', 'nulled'])) select__option_selected @endif" data-value="all">Все</div>
            <div class="select__option @if (request()->type == 'free') select__option_selected @endif" data-value="free">Бесплатные</div>
            <div class="select__option @if (request()->type == 'paid') select__option_selected @endif" data-value="paid">Платные</div>
            <div class="select__option @if (request()->type == 'nulled') select__option_selected @endif" data-value="nulled">Nulled</div>
        </div>
    </div>
    @endif
    @if ($from)
    <label for="from" class="label">От пользователя</label>
    <div class="select">
        <input type="hidden" name="from" value="{{ request()->from }}" class="select__data" data-on-change="submit">
        <input type="text" placeholder="Поиск..." class="input select__search" autocomplete="off" tabindex="0" minlength="2" data-url="{{ route('search.users') }}">
        <div class="select__selected">Не указан</div>
        <div class="select__options"></div>
    </div>
    @endif
</form>