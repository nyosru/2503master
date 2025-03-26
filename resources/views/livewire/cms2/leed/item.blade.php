<div>

    <style>
        body {
            /*overflow: hidden;*/
        }
    </style>

    {{--    <div class="flex flex-row bg-white border w-full rounded-md mb-2">--}}
    <div class="bg-white border w-full rounded-md mb-2 mt-[-15px] py-1 flex flex-row items-center">
        <div class="w-[500px] flex items-center">
            <a href="{{ route('leed.item', ['id' => $leed->id ]) }}">
                <div class="px-5 inline font-bold float-left mr-3">
                    <nobr>{{$leed->name}}</nobr>
                </div>
            </a>
            @section('head-line-content')
                <livewire:Cms2.App.Breadcrumb
                    {{--                :menu="[['route'=>'leed','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( $leed->name ?? 'Лид' ) ] ]"--}}
                    :menu="[['route'=>'leed','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ] ]"
                />
            @endsection
            {{--        </div>--}}
            {{--        <div class="p-2 flex-1 flex items-center">--}}

            <div class="inline">
                <div class="w-[300px] flex flex-row space-x-1 items-center">

                    <livewire:cms2.informer.leed.client wire:lazy :leed="$leed"/>
                    <livewire:cms2.informer.leed.order wire:lazy :leed="$leed"/>

                    {{--твои горящие задачи--}}
                    <livewire:cms2.informer.leed.order-you :key="'leed.order-you'.$leed->id" wire:lazy :leed="$leed"/>
                    {{--горящие задачи от других--}}
                    <livewire:cms2.informer.leed.order-to-you :key="'order-to-you'.$leed->id" wire:lazy :leed="$leed"/>
                    {{--кол-во комментариев и горит если есть непрочитанные другие--}}
                    <livewire:cms2.informer.leed.comment :key="'leed.comment'.$leed->id" wire:lazy :leed="$leed"/>
                    {{--передать лида--}}
                    <livewire:cms2.leed.move :leed="$leed"/>
                    {{--            </div>--}}
                    {{--            <b>{{ $leed->name }} тел: {{ $leed->phone }}</b>--}}
                    {{--        </div>--}}
                    {{--        <div class="p-2 flex-1">--}}
                </div>
            </div>

        </div>
    </div>

    <div class="flex flex-col sm:flex-row w-full space-x-2">

        {{--инфа о лиде--}}
        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            <div class="bg-white border-2 border-gray-400 w-full h-[645px] rounded-md">
                <livewire:cms2.leed.leed-record-info-form :leed="$leed"/>
            </div>
            {{--Ответсвенный за лид--}}
            <div class="bg-white border-2 border-gray-400  h-[145px] w-full rounded-md">
                <livewire:cms2.leed.leed-record-user-changes :leed="$leed"/>
            </div>
        </div>

        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            {{--комментарии--}}
            <div class="bg-white border-2 border-gray-400  h-[645px] w-full rounded-md">
                <livewire:cms2.leed.leed-record-comment :leed_record_id="$leed->id" wire:lazy/>
            </div>
            {{--истоиря действий--}}
            <div class="bg-white border-2 border-gray-400  h-[145px] w-full rounded-md">

                <div class="p-2 text-lg border-b ">
                    {{--                    <div class="inline float-right">1 2 3</div>--}}
                    <span class="font-bold">
                           История действий
                        </span>
                </div>

                <livewire:cms2.leed.item-log :leed_record_id="$leed->id" wire:lazy/>

            </div>
        </div>

        <div class="flex flex-col w-full md:w-1/3 space-y-2">
            {{--задачи--}}
            <div class="bg-white border-2 border-gray-400  h-[800px] w-full rounded-md">
                <livewire:cms2.leed.item-order :leed_record_id="$leed->id" wire:lazy/>
            </div>
        </div>

    </div>

</div>
