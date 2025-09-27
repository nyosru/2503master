<div>
    <div class="bg-white border
    w-full rounded-md mb-2 mt-[-15px] py-1
    flex flex-row items-center
    ">
        <div class="flex-1">
            <livewire:Cms2.App.Breadcrumb
                :board_id="$leed->column->board_id"
                :menu="[
                    ['route'=>'board.list','name'=>'Рабочие доски'],
                    [
                        'route'=>'board.show',
                        'name'=>( $leed->column->board->name ?? 'x' )
                    ],
                     [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]
                 ]"
            />
        </div>

        <div class="w-[300px] flex-1">
            <div class="w-[250px] flex flex-row space-x-1 items-center">

                @if(1==2)
                    <livewire:cms2.informer.leed.client wire:lazy :leed="$leed"/>
                @endif

                {{--                    <livewire:cms2.informer.leed.order wire:lazy :leed="$leed"/>--}}
                {{--твои горящие задачи--}}
                <livewire:cms2.informer.leed.order-you :key="'leed.order-you'.$leed->id" wire:lazy :leed="$leed"/>
                {{--горящие задачи от других--}}
                <livewire:cms2.informer.leed.order-to-you :key="'order-to-you'.$leed->id" wire:lazy :leed="$leed"/>
                {{--кол-во комментариев и горит если есть непрочитанные другие--}}
                <livewire:cms2.informer.leed.comment :key="'leed.comment'.$leed->id" wire:lazy :leed="$leed"/>

                {{--передать лида--}}
                {{--                    <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($leed,1) }}</pre>--}}
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

    @if(session('moveToColumnMessage'))
        <div
            x-data="{ showMessage: true }"
            class="fixed top-10 right-10 z-50"
        >
            <div
                x-show="showMessage"
                x-transition.opacity.duration.300ms
                class="bg-green-500 text-white p-4 rounded-lg shadow-lg flex flex-col items-start relative"
            >
                <!-- Кнопка закрытия -->
                <button
                    @click="showMessage = false"
                    class="absolute top-2 right-2 text-white text-xl font-bold hover:text-gray-200"
                >
                    &times;
                </button>

                <!-- Текст сообщения -->
                <p class="text-sm pr-5">
                    {{ session('moveToColumnMessage') }}
                </p>
            </div>
        </div>
    @endif



    @if (session()->has('moveMessage'))
        <span class="bg-green-500 text-white p-3 rounded">{{ session()->get('moveMessage') }}</span>
    @endif


    <div class="
        grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4
        px-4
    ">

        <div>
            {{--инфа о лиде--}}
            <div class="bg-white border-2 border-gray-400
            w-full rounded-md">

                <livewire:cms2.leed.leed-record-info-form
                    :leed="$leed"
                    :board_id="$leed->column->board->id"
                />
            </div>
        </div>

        <div class="
{{--        flex flex-col w-full md:w-1/3 space-y-2--}}
        ">
            {{--комментарии--}}
            <div class="bg-white border-2 border-gray-400  h-[645px] w-full rounded-md">
                <livewire:cms2.leed.leed-record-comment :leed_record_id="$leed->id" wire:lazy/>
            </div>
        </div>

        <div class="
{{--        flex flex-col w-full md:w-1/3 space-y-2--}}
        ">

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


        <div class="
{{--        flex flex-col w-full md:w-1/3 space-y-2--}}
        ">
            <div class="bg-white border-2 border-gray-400 w-full min-h-[200px] max-h-[645px] rounded-md
            overflow-auto">
                {{--оповещения--}}
                <livewire:leed.notification-component
                    :leed_id="$leed->id"
                    :board_id="$board_id"
                />
            </div>
        </div>

        @permission( 'р.Деньги')
        <div class="
{{--        flex flex-col w-full md:w-1/3 space-y-2--}}
        ">
            <div class="bg-white border-2 border-gray-400 w-full max-h-[645px] rounded-md
            overflow-auto">
                <livewire:leed.money-list-component :leedRecordId="$leed->id"/>
            </div>
        </div>
        @endpermission

        <div>
            <div class="bg-white border-2 border-gray-400
{{--            w-1/2 --}}
            rounded-md">
                <div class="p-2 text-lg border-b ">
                    <span class="font-bold">История действий</span>
                </div>
                <livewire:cms2.leed.item-log :leed_record_id="$leed->id" wire:lazy/>
            </div>
        </div>
        {{--            <div class="w-1/2 px-5">--}}

        <div>
            <div class="bg-white border-2 border-gray-400
{{--            w-1/2 --}}
            rounded-md">
                {{--                ответственный за лид--}}
                <livewire:cms2.leed.leed-record-user-changes :leed="$leed"/>
            </div>
        </div>

        <div>
            <div class="bg-white border-2 border-gray-400
{{--            w-1/2 --}}
            rounded-md"
            >
                {{--                ответственный за лид--}}
                <livewire:board.leed.block-qr-to-mini
                    :leed_id="$leed->id"
                    :board_id="$board_id"
                />

            </div>
        </div>

        <div>
            <div class="bg-white border-2 border-gray-400
{{--            w-1/2 --}}
            rounded-md"
            >
                {{--                ответственный за лид--}}
                <livewire:board.leed.item-mini-document-links
                    :leed="$leed"
                    :board_id="$board_id"
                />

            </div>
        </div>

    </div>
</div>
