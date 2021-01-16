<div class="select">
    <select name="{{ $name }}" class="select__original">
        @foreach ($options as $value => $title)
        <option value="{{ $value }}" @if ($selected == $value) selected @endif>{{ $title }}</option>
        @endforeach
    </select>
    <div class="select__beauty">
        <div class="select__trigger">
            @if (isset($label))
            <span class="select__label">{{ $label }}</span>
            @endif
            <span class="select__selected">{{ $options[$selected] }}</span>
        </div>
        <div class="select__options">
            @foreach ($options as $value => $title)
            <span class="select__option @if ($selected == $value) select__option--selected @endif" data-value="{{ $value }}">{{ $title }}</span>
            @endforeach
        </div>
    </div>
</div>