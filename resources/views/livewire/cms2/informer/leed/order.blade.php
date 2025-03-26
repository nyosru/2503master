<div title="Заказ"
     class="rounded
     flex-auto
     inline
         bg-white
         border-2 border-gray-200
{{--          w-[35px]--}}
{{--          w-[40px]--}}
{{--         h-[35px]--}}
{{--         px-2--}}
h-[28px]
         overflow-hidden
         flex items-center
         justify-center
         text-black
          text-center
         "
>
    @if( empty($leed->client_id) )
        <span
            class="inline p-1 rounded m-0 bg-white/30"
            title="для создания заказа, добавте клиента">
{{--                <img--}}
{{--                    src="/icon/dogovor.blank.png"--}}
{{--                    class="w-5 inline opacity-50"--}}
{{--                />--}}
            <svg class="h-5 w-5 text-gray-200"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
</svg>

            </span>
    @else
        {{-- уже есть заказ--}}
        @if( !empty($leed->order_id) )

            <a
                href="{{ config('custom.order_info').$leed->order_id }}"
                title="Заказ: {{ $leed->order->name ?? '-' }}"
            >
                {{ $virtual_order_id ?? '#x' }}
            </a>
            {{-- ещё нет заказ--}}
        @else
            <a
                href="{{ route('order.create',[ 'return_url' => 'leed', 'return_leed' => $leed->id, 'client_to_order_id'=>$leed->client_id]) }}"
                wire:navigate
            >
{{--                <img src="/icon/dogovor.blank.png"--}}
{{--                     class="w-5 mb-1 inline-block"/>--}}
                <svg class="h-5 w-5 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </a>
            @if( isset($showModalCreateOrder[$leed->id]) && $showModalCreateOrder[$leed->id] )
                <livewire:Cms2.Order.CreateOrderModal
                    key="ocm{{$leed->id}}"
                    :record_id="$leed->id"
                    :client_to_order_id="$leed->client_id "
                    return_url='leed'
                />
            @endif
        @endif
    @endif
</div>
