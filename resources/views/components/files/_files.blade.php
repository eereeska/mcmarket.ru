<div class="list">
    @each('components.files._file', $files, 'file', 'components._empty')
{{ $files->links() }}
</div>
{{-- @if ($files->hasMorePages())
<a href="{{ $files->nextPageUrl() }}" class="button primary" data-action="load-more" data-target="#files">Загрузить ещё</a>
@endif --}}