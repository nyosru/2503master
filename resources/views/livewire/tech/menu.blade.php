<div class="flex flex-wrap space-y-1 space-x-1 my-6 justify-center ">
    {{--        <pre>{{ print_r($links) }}</pre>--}}
    @foreach( $links as $name => $v )
        @if( !empty($v['permission']) && !empty($v['route']) )
            @permission($v['permission'])
            <a href="{{route($v['route'])}}"
               wire:navigate
               class="
                   hover:bg-gradient-to-tr
                   hover:from-orange-300
                   hover:to-bg-cyan-300
                   {{ Request::routeIs($v['route']) ? 'bg-orange-300' : 'bg-cyan-300' }}
                     px-2 py-1 whitespace-nowrap
                     rounded"
            >{{ $name }}</a>
            @endpermission
        @else
            <a href="{{route($v['route'])}}"
               wire:navigate
               class=" bg-cyan-300 px-2 py-1 whitespace-nowrap rounded
               hover:bg-gradient-to-tr
                   hover:from-orange-300
                   hover:to-bg-cyan-300
                   {{ Request::routeIs($v['route']) ? 'bg-orange-300' : 'bg-cyan-300' }}
               "
            >{{ $name }}</a>
        @endif
    @endforeach
</div>
