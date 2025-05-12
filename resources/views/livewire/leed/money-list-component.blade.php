<div>
    <div class="p-2 text-lg border-b">

        @permission( 'р.Деньги / добавлять записи')
        <button wire:click="showCreateForm"
                class=" float-right
                    w-[40px]
                    mt-[-2px]
                    text-blue-500
                    text-[36px]
                    font-bold
                    {{--                rounded--}}
                    "
                title="Добавить">+
        </button>
        @endpermission

        <span class="font-bold flex items-center">
            Движение денег
{{--            @if(!empty($summa))--}}
            <span title="Текущий итог" class="pl-2
            @if($summa>0)
            text-gray-400
            @else
            text-red-300
            @endif
            ">{{ number_format($summa, 0) }}₽</span>
{{--                @endif--}}
            </span>


        {{--        @if (session()->has('messageItemInfo'))--}}
        {{--            <span--}}
        {{--                x-data="{ show: true }"--}}
        {{--                x-init="setTimeout(() => show = false, 3000)"--}}
        {{--                x-show="show"--}}
        {{--                x-transition--}}
        {{--                title="{{ session('messageItemInfo') }}" class="bg-green-300 p-1">--}}
        {{--                {{ session('messageItemInfo') }}--}}
        {{--            </span>--}}
        {{--        @endif--}}

        @if (session()->has('moneyMessage'))
            <div class="bg-green-200 p-2 mb-4 rounded"
                 x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 3000)"
                 x-show="show"
                 x-transition
            >
                {{ session('moneyMessage') }}
            </div>
        @endif

    </div>

    <div class="space-y-4">

        {{--        @if(session()->has('message'))--}}
        {{--            <div class="p-4 bg-green-100 text-green-700 rounded-lg">--}}
        {{--                {{ session('message') }}--}}
        {{--            </div>--}}
        {{--        @endif--}}

        <div class="divide-y divide-gray-200">

            @permission( 'р.Деньги / добавлять записи')
            @if($showForm)
                <livewire:leed.money-form :leedRecordId="$leed_record_id"/>
            @endif
            @endpermission


            @permission( 'р.Деньги / видеть записи')
            @forelse($payments as $payment)
{{--                <div>{{ print_r($payment->toArray()) }}</div>--}}
                <div class="px-2 py-4 flex flex-row justify-between
                @if($payment->deleted_at) line-through @endif
                items-center hover:bg-gray-100">

                    <div class="
                    flex-1
{{--                    w-[90px] --}}
                    text-right">
                        <div class="font-medium">{{ number_format($payment->amount, 0) }} ₽</div>
                    </div>
                    <div class="flex-1 pl-2">

                        {{--                        <div class="float-right text-xs text-gray-400 mt-1">--}}
                        {{--                            @if( !empty($payment->operation_date) )--}}
                        {{--                                {{ \DateTime::createFromFormat('Y-m-d H:i:s', $payment->operation_date)->format('d.m.Y H:i') }}--}}
                        {{--                            @endif--}}
                        {{--                            ({{ $payment->user->name }})--}}
                        {{--                        </div>--}}

                        {{--                        <div class="font-medium">{{ number_format($payment->amount, 2) }} ₽</div>--}}

                        @if($payment->comment)
                            <div class="text-sm">{{ $payment->comment }}</div>
                        @endif

                    </div>
                    {{--                    <div class="w-[120px]">--}}
                    <div class="flex-1 text-xs text-gray-600">
                        @if( !empty($payment->operation_date) )
                            {{ \DateTime::createFromFormat('Y-m-d H:i:s', $payment->operation_date)->format('d.m.Y H:i') }}<br/>
                        @endif
                        {{ $payment->user->name }}
                    </div>
                    @if(empty($payment->deleted_at))
                    @permission( 'р.Деньги / удалять записи')
                    <button
                        wire:confirm="Удалить эту запись?"
                        wire:click="delete({{ $payment->id }})"
                        class="text-red-500 hover:text-red-700 text-sm mx-2"
                    >
                        ✕
                    </button>
                    @endpermission
                     @endif
                </div>
            @empty
                <div class="py-4 text-gray-500">
                    Нет записей о платежах
                </div>
            @endforelse
            @endpermission
        </div>

        {{ $payments->links() }}
    </div>
</div>
