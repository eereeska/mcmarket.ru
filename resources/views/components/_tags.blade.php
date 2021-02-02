@foreach ($tags as $tag)
    <label class="checkbox tag{{ (isset($class)) ? ' ' . $class : '' }}">
        <input type="checkbox" name="tags[{{ $tag->name }}]" @if (request()->tags and in_array($tag->name, array_keys(request()->tags))) checked="on" @endif @if (isset($disabled) and $disabled) disabled="disabled" @endif>
        <span class="checkbox__label icon icon--{{ $tag->icon }}">{{ $tag->title }}</span>
    </label>
@endforeach