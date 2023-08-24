@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link text-bg-secondary text-dark" href="#"><</a></li>
        @else
            <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $paginator->previousPageUrl() }}" rel="prev"><</a></li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link text-bg-secondary" href="#">{{ $element }}</a></li>
            @endif


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link border-secondary text-bg-dark text-secondary fw-bold" href="#">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $paginator->nextPageUrl() }}" rel="next">></a></li>
        @else
            <li class="page-item disabled"><a class="page-link text-bg-secondary text-dark fw-bold" href="#">></a></li>
        @endif
    </ul>
@endif
