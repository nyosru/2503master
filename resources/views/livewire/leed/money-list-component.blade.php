<div>
    <div class="p-2 text-lg border-b">

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

        <span class="font-bold flex items-center">
            Движение денег
            @if(!empty($summa))
            <span title="Текущий итог" class="pl-2 text-gray-400">{{ number_format($summa, 0) }}₽</span>
                @endif
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

            @if($showForm)
                <livewire:leed.money-form :leedRecordId="$leed_record_id"/>
            @endif

            @forelse($payments as $payment)
                <div class="px-2 py-4 flex justify-between items-center">
                    <div class="flex-1">

                        <div class="float-right text-xs text-gray-400 mt-1">
                            @if( !empty($payment->operation_date) )
                                {{ \DateTime::createFromFormat('Y-m-d H:i:s', $payment->operation_date)->format('d.m.Y H:i') }}
                            @endif
                            ({{ $payment->user->name }})
                        </div>

{{--                        <div class="font-medium">{{ number_format($payment->amount, 2) }} ₽</div>--}}
                        <div class="font-medium">{{ number_format($payment->amount, 0) }} ₽</div>

                        @if($payment->comment)
                            <div class="text-gray-600 text-sm">{{ $payment->comment }}</div>
                        @endif

                    </div>
                    <button
                        wire:confirm="Удалить эту запись?"
                        wire:click="delete({{ $payment->id }})"
                        class="text-red-500 hover:text-red-700 text-sm mx-2"
                    >
                        ✕
                    </button>
                </div>
            @empty
                <div class="py-4 text-gray-500">
                    Нет записей о платежах
                </div>
            @endforelse
        </div>

        {{ $payments->links() }}
    </div>
</div>
