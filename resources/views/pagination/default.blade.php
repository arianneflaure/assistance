@if ($paginator->hasPages())
    <ul class="unstyled inbox-pagination">
		<li>
		<span>{{($paginator->currentpage()-1)*$paginator->perpage()+1}}- 
		{{(($paginator->currentpage()-1)*$paginator->perpage())+$paginator->count()}} of {{$paginator->total()}} 
		</span>
		</li>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="np-btn"><i class="fa fa-angle-left  pagination-left"></i></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="np-btn"><i class="fa fa-angle-left  pagination-left"></i></a></li>
        @endif

       <!-- {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach-->

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="np-btn"><i class="fa fa-angle-right  pagination-right"></i></a></li>
        @else
            <li class="disabled"><span class="np-btn"><i class="fa fa-angle-right  pagination-right"></i></span></li>
        @endif
    </ul>
@endif