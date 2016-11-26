@if ($paginator->hasPages())
    {{-- <ul class="pagination"> --}}
    <div class="ui right floated pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <li class="disabled"><span>&laquo;</span></li> --}}
            <a href="{{ $paginator->previousPageUrl() }}" class="icon item disabled">
              <i class="left chevron icon"></i>
            </a>
        @else
            {{-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li> --}}
            <a href="{{ $paginator->previousPageUrl() }}" class="icon item">
              <i class="left chevron icon"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
{{--             @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif --}}

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- <li class="active"><span>{{ $page }}</span></li> --}}
                        <a class="item active">{{ $page }}</a>
                    @else
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                        <a href="{{ $url }}" class="item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            {{-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li> --}}
            <a href="{{ $paginator->nextPageUrl() }}" class="icon item">
              <i class="right chevron icon"></i>
            </a>
        @else
            {{-- <li class="disabled"><span>&raquo;</span></li> --}}
            <a class="icon item disabled">
              <i class="right chevron icon"></i>
            </a>
        @endif
    {{-- </ul> --}}
    </div>
@endif
