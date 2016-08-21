<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        @for($i = $items->currentPage() - 3; $i < $items->currentPage() + 3; $i++)
            @if($i >= 1 && $i <= $items->lastPage())
                <li class="page-item {{ $i == $items->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor

        <li class="page-item">
            <a class="page-link" href="{{ $items->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
