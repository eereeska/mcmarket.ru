@foreach ($tags as $tag)
    <label class="checkbox tag{{ (isset($fluid) and $fluid) ? ' fluid' : '' }}">
        <input type="checkbox" name="tags[{{ $tag->name }}]" @if (request()->tags and in_array($tag->name, array_keys(request()->tags))) checked="on" @endif>
        <span class="checkbox__label icon icon--{{ $tag->icon }}">{{ $tag->title }}</span>
    </label>
@endforeach