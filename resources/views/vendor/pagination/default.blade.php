<!-- resources/views/vendor/pagination/custom-pagination.blade.php -->

<div class="d-flex justify-content-center">
    <ul class="pagination mt-4">
        <!-- Page Numbers -->
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

    <!-- Move the "Previous" button here -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

    <!-- "Next" button with border -->
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link next-button" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
        @endif
    </ul>
</div>
