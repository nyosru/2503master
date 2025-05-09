<div>
    <style>
        body {
            /*overflow: hidden;*/
        }
    </style>


    {{--    <div class="flex flex-row bg-white border w-full rounded-md mb-2">--}}
    <div class="bg-white border w-full rounded-md mb-2 mt-[-15px] py-1
    flex flex-row items-center
    ">
        {{--        <div class="flex items-center">--}}

        <div class="flex-1">

            {{--            <div>--}}
            {{--            111--}}
            {{--            <pre class="text-xs" >{{ print_r($leed,true) }}</pre>--}}
            {{--222--}}
            {{--            </div>--}}

            <livewire:Cms2.App.Breadcrumb
                :board_id="$leed->column->board_id"
                {{--                :menu="[['route'=>'leed','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( $leed->name ?? 'Лид' ) ] ]"--}}
                :menu="[

{{--                ['route'=>'leed.list','name'=>'Лиды'],--}}
                                    ['route'=>'leed.list','name'=>'Рабочие доски'],
                                    [
                                        'route'=>'leed',
{{--                                        'route-var'=>['board_id'=> ($leed->column->board->id ?? 0 )],--}}
{{--                                        'route-var'=>['board_id'=> ($board_id ?? 0 )],--}}
                                        'name'=>( $leed->column->board->name ?? 'x' )
                                    ],

                 [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]

                 ]"
            />
        </div>

        {{--            <a href="{{ route('leed.item', ['id' => $leed->id, 'board_id' => $leed->column->board_id ?? 0 ]) }}">--}}
        {{--                <div class="px-5 inline font-bold float-left mr-3">--}}
        {{--                    <nobr>{{$leed->name}}</nobr>--}}
        {{--                </div>--}}
        {{--            </a>--}}

        {{--            @section('head-line-content')--}}
        {{--                <livewire:Cms2.App.Breadcrumb--}}
        {{--                    --}}{{--                :menu="[['route'=>'leed','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( $leed->name ?? 'Лид' ) ] ]"--}}
        {{--                    :menu="[['route'=>'leed.list','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ] ]"--}}
        {{--                />--}}
        {{--            @endsection--}}

        {{--        </div>--}}
        {{--        <div class="p-2 flex-1 flex items-center">--}}

        {{--            <div class="inline">--}}
        <div class="w-[300px] flex-1">
            <div class="w-[250px] flex flex-row space-x-1 items-center">

                <livewire:cms2.informer.leed.client wire:lazy :leed="$leed"/>
                {{--                    <livewire:cms2.informer.leed.order wire:lazy :leed="$leed"/>--}}
                {{--твои горящие задачи--}}
                <livewire:cms2.informer.leed.order-you :key="'leed.order-you'.$leed->id" wire:lazy :leed="$leed"/>
                {{--горящие задачи от других--}}
                <livewire:cms2.informer.leed.order-to-you :key="'order-to-you'.$leed->id" wire:lazy :leed="$leed"/>
                {{--кол-во комментариев и горит если есть непрочитанные другие--}}
                <livewire:cms2.informer.leed.comment :key="'leed.comment'.$leed->id" wire:lazy :leed="$leed"/>

                {{--передать лида--}}
                @if( $leed->user_id == Auth()->user()->id )
                    <livewire:cms2.leed.move :leed="$leed" :board_id="$leed->column->board->id"/>
                @endif

                {{--            </div>--}}
                {{--            <b>{{ $leed->name }} тел: {{ $leed->phone }}</b>--}}
                {{--        </div>--}}
                {{--        <div class="p-2 flex-1">--}}
            </div>
        </div>

        {{--        </div>--}}
    </div>


    {{--    <pre class="text-xs">{{ print_r($leed->user_id) }}</pre>--}}
    {{--    <br/>--}}
    {{--    ++{{ Auth()->user()->id }}--}}
    {{--    <br/>--}}
    {{--    <pre class="text-xs">{{ print_r($leed->toArray()) }}</pre>--}}
    {{--    <pre class="text-xs">{{ print_r($column->toArray()) }}</pre>--}}
    @if (session()->has('moveMessage'))
        <span class="bg-green-500 text-white p-3 rounded">{{ session()->get('moveMessage') }}</span>
    @endif

    <div class="flex flex-col sm:flex-row w-full space-x-2 pr-3">

        {{--инфа о лиде--}}
        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            <div class="bg-white border-2 border-gray-400 w-full h-[645px] rounded-md
            overflow-auto">
                <livewire:cms2.leed.leed-record-info-form
                    :leed="$leed"
                    :board_id="$leed->column->board->id"
                />
            </div>
            {{--Ответсвенный за лид--}}
            {{--            <div class="bg-white border-2 border-gray-400  h-[145px] w-full rounded-md">--}}
            {{--                <livewire:cms2.leed.leed-record-user-changes :leed="$leed"/>--}}
            {{--            </div>--}}
        </div>

        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            {{--комментарии--}}
            <div class="bg-white border-2 border-gray-400  h-[645px] w-full rounded-md">
                <livewire:cms2.leed.leed-record-comment :leed_record_id="$leed->id" wire:lazy/>
            </div>
            {{--истоиря действий--}}
            {{--            <div class="bg-white border-2 border-gray-400  h-[145px] w-full rounded-md">--}}


            {{--            </div>--}}
        </div>

        <div class="flex flex-col w-full md:w-1/3 space-y-2">

            <div class="bg-white border-2 border-gray-400  h-[700px] w-full rounded-md">
                <livewire:file.manager :leed="$leed"
                                       :board_id="$leed->column->board->id"
                                       wire:lazy/>
            </div>

            {{--задачи--}}
            @if(1==2)
                <div class="bg-white border-2 border-gray-400  h-[800px] w-full rounded-md">
                    <livewire:cms2.leed.item-order :leed_record_id="$leed->id" wire:lazy/>
                </div>
            @endif

        </div>

    </div>

    {{--    строчка 2--}}

    <div class="flex flex-col sm:flex-row w-full space-x-2 pr-3">

        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            <div class="bg-white border-2 border-gray-400 w-full h-[645px] rounded-md
            overflow-auto">
                {{--оповещения--}}
                <livewire:leed.notification-component
                    {{--                :leed="$leed"--}}
                    :leed_id="$leed->id"
                    {{--                    :board_id="$leed->column->board->id"--}}
                />
            </div>
        </div>
        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            <div class="bg-white border-2 border-gray-400 w-full h-[645px] rounded-md
            overflow-auto">

                <livewire:leed.money-list-component :leedRecordId="$leed->id"/>


            </div>
        </div>
        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            {{--        3--}}
        </div>
    </div>

    {{--    строчка 3--}}

    <div class="flex flex-col w-full space-y-2 my-5">
        <div class="flex flex-row space-x-5">
            {{--            <div class="w-1/2  px-5">--}}
            <div class="bg-white border-2 border-gray-400 w-1/2 rounded-md">

                <div class="p-2 text-lg border-b ">
                    {{--                    <div class="inline float-right">1 2 3</div>--}}
                    <span class="font-bold">История действий</span>
                </div>
                <livewire:cms2.leed.item-log :leed_record_id="$leed->id" wire:lazy/>

            </div>
            {{--            <div class="w-1/2 px-5">--}}
            <div class="bg-white border-2 border-gray-400 w-1/2 rounded-md">
                {{--                ответственный за лид--}}
                <livewire:cms2.leed.leed-record-user-changes :leed="$leed"/>
            </div>
        </div>

    </div>
    <div>

    </div>
</div>
