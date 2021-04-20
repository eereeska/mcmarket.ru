@if ($paginator->hasPages())
    <nav class="pagination">
        @if ($paginator->onFirstPage())
            <span class="pagination__link pagination__link--prev pagination__link--disabled"></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination__link pagination__link--prev"></a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination__link pagination__link--select">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__link pagination__link--current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination__link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination__link pagination__link--next"></a>
        @else
            <span class="pagination__link pagination__link--next pagination__link--disabled"></span>
        @endif
    </nav>
@endif
{{-- #TODO: сделай пагинацию --}}