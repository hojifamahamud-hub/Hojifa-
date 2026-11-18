@if($paginator->hasPages())
    <nav>
        @if($paginator->onFirstPage())
            <span class="pagination-link">←</span>
        @else
            <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">←</a>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <span class="pagination-link">{{ $element }}</span>
            @endif
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <span class="pagination-link current">{{ $page }}</span>
                    @else
                        <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">→</a>
        @else
            <span class="pagination-link">→</span>
        @endif
    </nav>
@endif
