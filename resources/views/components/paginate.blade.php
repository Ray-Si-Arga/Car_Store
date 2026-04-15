<style>
    .pagination-wrapper {
        display: flex;
        margin-top: 12px;
        justify-content: space-between;
        align-items: center;
        padding: 15px 24px;
        background: white;
        border-top: 1px solid #edf2f7;
        border-radius: 12px;
    }

    .pagination-info {
        font-size: 14px;
        color: #64748b;
    }

    .pagination-info strong {
        color: #334155;
        font-weight: 600;
    }

    .pagination-links {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .pagination-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 8px;
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination-item:hover:not(.disabled):not(.active) {
        border-color: #635bff;
        color: #635bff;
        background: #f8faff;
    }

    .pagination-item.active {
        background: #635bff;
        border-color: #635bff;
        color: #fff;
    }

    .pagination-item.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8fafc;
    }

    .pagination-item.prev-next {
        padding: 0 12px;
        font-weight: 600;
        font-size: 13px;
        color: #475569;
    }

    .pagination-dots {
        color: #94a3b8;
        padding: 0 4px;
    }

    @media (max-width: 640px) {
        .pagination-wrapper {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
    }
</style>

@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Menampilkan <strong>{{ $paginator->firstItem() }}</strong> - <strong>{{ $paginator->lastItem() }}</strong> dari
            <strong>{{ $paginator->total() }}</strong> data
        </div>

        <div class="pagination-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-item prev-next disabled">Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item prev-next">Prev</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item prev-next">Next</a>
            @else
                <span class="pagination-item prev-next disabled">Next</span>
            @endif
        </div>
    </div>
@endif