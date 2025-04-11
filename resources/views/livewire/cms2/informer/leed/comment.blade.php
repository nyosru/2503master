<div title="комментарии, всего: {{ $totalCount ?? 0 }} горящих: {{$count}}"
     class="
     flex-auto
     rounded
{{--     px-2 py-1 xml-3 --}}
     inline
     text-gray-500
     text-center
         @if( $count > 0 ) bg-red-500 @else bg-white border-2 border-gray-200 @endif
         "
><a wire:navigate href="{{ route('leed.item',['board_id' => ($leed->board_id ?? '0'),'id'=>$leed->id]) }}">
        <nobr>@if( $count > 0 ){{$count}}@else{{ $totalCount ?? '-' }}@endif<img
                src="/icon/comment.svg"
                class="ml-1 mb-1 inline w-4"/></nobr>
    </a>
</div>
