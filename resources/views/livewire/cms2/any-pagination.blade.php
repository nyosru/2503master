@if ($paginator->hasPages())
{{--777--}}
    <nav class="d-flex px-5 justify-items-center justify-content-between">
{{--        pag-boot51--}}
{{--        <br/>--}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
{{--                            @lang('pagination.previous')--}}
                            <
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
{{--                           wire:navigate--}}
{{--                           href="{{ $paginator->previousPageUrl() }}" --}}

                            href="#"
                           wire:click.prevent="setPage({{ $paginator->currentPage() - 1 }})"

                           rel="prev">
{{--                            @lang('pagination.previous')--}}
                            <
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link"

{{--                           wire:navigate--}}
{{--                           href="{{ $paginator->nextPageUrl() }}"--}}

                           href="#"
                           wire:click.prevent="setPage({{ $paginator->currentPage() + 1 }})"

                           rel="next" >
{{--                            @lang('pagination.next')--}}
                            >
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
{{--                            @lang('pagination.next')--}}
                            >
                        </span>
                    </li>
                @endif


            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
{{--                    {!! __('Showing') !!}--}}
                    Показаны с
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
{{--                    {!! __('to') !!}--}}
                    по
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
{{--                    {!! __('of') !!}--}}
                    <br/>Всего:
                    <span class="fw-semibold">{{ $paginator->total() }}</span>

{{--                    {!! __('results') !!}--}}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true"
{{--                            aria-label="@lang('pagination.previous')"--}}
                        >
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"
{{--                               wire:navigate--}}
{{--                               href="{{ $paginator->previousPageUrl() }}"--}}
                               href="#"
                               wire:click="setPage({{ $paginator->currentPage() - 1 }})"
                               rel="prev"
{{--                               aria-label="@lang('pagination.previous')"--}}
                            >&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
{{--                                         wire:navigate--}}
{{--                                         href="{{ $url }}"--}}
                                                             href="#"
                                                             wire:click="setPage({{ $page }})"
                                        >{{ $page }}
{{--                                            <small>/ {{ $url }}</small>--}}
                                        </a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link"
{{--                               href="{{ $paginator->nextPageUrl() }}"--}}
                               rel="next"
{{--                               aria-label="@lang('pagination.next')"--}}

                               href="#"
                               wire:click="setPage({{ $paginator->currentPage() + 1 }})"

                            >&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
