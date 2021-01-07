@foreach ($tags as $tag)
    <a href="#" class="tag {{ $tag->name }}">{{ $tag->title }}</a>
@endforeach