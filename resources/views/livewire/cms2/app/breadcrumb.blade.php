<div class="inline-block breadcrumb xfloat-sm-end d-flex flex-wrap text-gray-600 m-3 bg-white rounded px-4">

{{--    <span class="breadcrumb-item"><a href="/" class="hover:bg-orange-200 px-1" wire:navigate>ПроцессМастер</a></span>--}}
    {{--    <span class="breadcrumb-item"><a href="/" class="hover:bg-orange-200 px-1" wire:navigate>Marudi</a></span>--}}
    {{--    <li class="breadcrumb-item"><a wire:navigate href="{{ route('clients') }}">Клиенты</a></li>--}}

{{--    <pre class="text-xs"> {{ print_r($menu) }}</pre>--}}

    @foreach( $menu as $k => $m )
        @if($k > 0) / @endif
        @if( isset($m['link']) && $m['link'] == 'no' )
            <span class="breadcrumb-item active xme-2" aria-current="page">
            @else
{{--                    <pre>--}}
{{--                        {{ print_r($m['route']) }}--}}
{{--                        <br/>--}}
{{--                        {{ print_r($m['route-var']) }}--}}
{{--                    </pre>--}}
{{--                    wire:navigate href="{{ route($m['route'], ( $m['route-var'] ?? [] ) ) }}"--}}

                    <span class="hover:bg-orange-200 px-1 breadcrumb-item xme-2"><a
                            wire:navigate href="{{ route($m['route'], ( $m['route-var'] ?? [] ) ) }}"
                        >
                @endif

                        {!! $m['name'] !!}
                        @if( isset($m['link']) && $m['link'] == 'no' )
                </span>
                    @else
                        </a></span>
        @endif
    @endforeach
</div>
