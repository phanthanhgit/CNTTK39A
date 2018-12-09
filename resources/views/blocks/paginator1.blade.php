@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="paginate_button previous disabled">
                    <span class="page-link">Trước</span>
                </li>
            @else
                <li class="paginate_button previous">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <span>Trước</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button active"><span class="page-link">{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li class="paginate_button"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="paginate_button disabled"><span class="page-link"><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <span>Sau</span>
                    </a>
                </li>
            @else
                <li class="paginate_button next disabled">
                    <span class="page-link">Sau</span>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif