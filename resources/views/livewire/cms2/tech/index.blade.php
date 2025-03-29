<div>
    <div class="mb-5">
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
{{--                                ['route'=>'tech.product-type-manager','name'=>'Типы изделий'],--}}
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="flex flex-wrap">
        @foreach( $links as $name => $v )

            @if( !empty($v['permission']) )
                {{--            11 /<br/>--}}
                {{--            {{$v['route']}} /<br/>--}}
                {{--            {{route($v['route'])}}--}}
                {{--        <br/>--}}

                @permission($v['permission'])

                <a href="{{route($v['route'])}}"
                   wire:navigate
                   class="hover:bg-orange-300 bg-cyan-300 px-2 py-1 m-1 block-inline rounded"
                    {{--       wire:click.prevent="$set('show_me', 'ProductTypeManager')" --}}
                >{{ $name }}</a>

                @endpermission

            @else
                <a href="{{route($v['route'])}}"
                   wire:navigate
                   class="hover:bg-orange-300 bg-cyan-300 px-2 py-1 m-1 block-inline rounded"
                    {{--       wire:click.prevent="$set('show_me', 'ProductTypeManager')" --}}
                >{{ $name }}</a>
            @endif

        @endforeach
    </div>
    {{--<div class="flex flex-row">--}}
    {{--    <div class="w-1/5">--}}
    {{--<a href="#"--}}
    {{--   class="@if( $show_me == 'ProductTypeManager' ) bg-orange-400 @else bg-gray-100 @endif p-1 m-1 block"--}}
    {{--   wire:click.prevent="$set('show_me', 'ProductTypeManager')" >Тип продукции</a>--}}
    {{--    </div>--}}
    {{--    <div class="w-4/5">--}}
    {{--        @if( $show_me == 'ProductTypeManager' )--}}
    {{--            <livewire:cms2.tech.product-type-manager />--}}
    {{--        @endif--}}
    {{--    </div>--}}
</div>
