@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link-urbangreen">
                        <i class="fas fa-chevron-left me-1"></i> Précédent
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-urbangreen" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left me-1"></i> Précédent
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link page-link-urbangreen">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link page-link-urbangreen-active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link page-link-urbangreen" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-urbangreen" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Suivant <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link-urbangreen">
                        Suivant <i class="fas fa-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
.page-link-urbangreen {
    border: 2px solid #e8f5e8;
    color: var(--urbangreen-dark);
    margin: 0 0.3rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.page-link-urbangreen:hover {
    background: var(--urbangreen-gradient);
    border-color: var(--urbangreen-primary);
    color: white;
    transform: translateY(-2px);
}

.page-link-urbangreen-active {
    background: var(--urbangreen-gradient) !important;
    border-color: var(--urbangreen-primary) !important;
    color: white !important;
    box-shadow: 0 0.25rem 0.75rem rgba(45, 206, 137, 0.3);
}
</style>