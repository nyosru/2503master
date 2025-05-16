<div title="Мои Задачи (поставлены другими пользователями)"
     class="
     flex-auto
     rounded
     px-2
     py-1
     mt-1
{{--     py-1 xml-3 --}}
     inline-block
      text-center
     text-gray-500
{{--         @if( $ordersCount > 0 ) bg-red-500 @else  --}}
         bg-white border-2 border-gray-200
         hover:bg-blue-300 hover:font-bold hover:px-1
{{--@endif--}}
         "
><button wire:click="getThisLeed()"
{{--        wire:navigate href="{{ route() }}--}}
{{--{{ route('leed.item',['board_id' => ($leed->board_id ?? '0'),'id'=>$leed->id]) }}--}}
{{--"--}}
    >
{{--        {{ $ordersCountTotal ?? '-' }}--}}
        Взять в работу
    </button>
    {{--    <pre class="text-xs">{{ print_r($ordersCount->toArray()) }}</pre>--}}
    {{--    <pre class="text-xs max-h-[100px] overflow-auto">{{ print_r($leed->toArray()) }}</pre>--}}
</div>
