<section class="section section_compact">
    @isset($label)
    <div class="section__header">
        <label for="{{ $name }}" class="section__title">{{ $label }}</label>
    </div>
    @endisset
    <div class="section__content">
        <div class="select">
            @isset($submit)
            <input type="hidden" name="{{ $name }}" class="select__data" data-on-change="submit">
            @else
            <input type="hidden" name="{{ $name }}" class="select__data">
            @endisset
            @if (isset($search))
            <input type="text" placeholder="Поиск..." class="input select__search" autocomplete="off" tabindex="0" minlength="2" data-url="{{ $search['url'] }}">
            @endif
            @if (isset($options) and array_key_exists($selected, $options))
            <div class="select__selected">{{ $options[$selected] }}</div>
            @else
            <div class="select__selected">{{ $default }}</div>
            @endif
            @isset($options)
            <div class="select__options">
                @isset($reset)
                @if (array_key_exists($selected, $options))
                <div class="select__option select__option_reset" data-value="none">{{ $default }}</div>
                @else
                <div class="select__option select__option_selected select__option_reset" data-value="none">{{ $default }}</div>
                @endif
                @endisset
                @foreach ($options as $key => $title)
                @if ($selected == $key)
                @if (isset($icons) and array_key_exists($key, $icons))
                <div class="select__option icon icon_{{ $icons[$key] }} select__option_selected" data-value="{{ $key }}">{{ $title }}</div>
                @else
                <div class="select__option select__option_selected" data-value="{{ $key }}">{{ $title }}</div>
                @endif
                @else
                @if (isset($icons) and array_key_exists($key, $icons))
                <div class="select__option icon icon_{{ $icons[$key] }}" data-value="{{ $key }}">{{ $title }}</div>
                @else
                <div class="select__option" data-value="{{ $key }}">{{ $title }}</div>
                @endif
                @endif
                @endforeach
            </div>
            @else
            <div class="select__options"></div>
            @endif
        </div>
    </div>
</section>