@if ($paginator->hasPages())
    <nav aria-label="navegacao-forum" class="navigation-pages my-4">
        <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item" disabled>
                <a class="page-link"><i class="fas fa-angle-left"></i></a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"></i></a>
            </li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="page-item" disabled>
                    <a class="page-link">{{ $element }}</a>
                </li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i></a>
            </li>
        @else
            <li class="page-item" disabled>
                <a class="page-link"><i class="fas fa-angle-right"></i></a>
            </li>
        @endif
        </ul>
    </nav>
@endif
