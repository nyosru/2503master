<div class="flex flex-row space-x-1">

    <div class="flex flex-col w-[120px] space-y-1">

        <div class="bg-blue-400 text-white text-center w-full rounded">Перенос</div>
        {{--        @if( $i->status == 'готово')--}}
        {{--            <div class="bg-blue-400 text-white text-center w-full rounded">Завершена</div>--}}
        {{--        @elseif($i->status == 'отменена' )--}}
        {{--            <div class="bg-blue-400 text-white text-center w-full rounded">Отменена</div>--}}
        {{--        @endif--}}

        @if( !empty($i->transferred_at) )
            <div
                class="bg-blue-400 text-white text-center w-full rounded">{{ date('H:i d.m.y',strtotime($i->transferred_at)) }}</div>
        @endif

    </div>
    <div class="flex-1">

        {{--                <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($i->toArray()) }}</pre>--}}

        @if( !empty($i->msg) )
            <div class="border border-blue-400 rounded px-2 py-1 min-h-[3rem]">
                <div class="text-xs ">
                    <span class="text-xs text-blue-400 p-1  @if($i->user->deleted_at) line-through @endif ">
                        <svg class="inline h-4 w-4 text-blue-400"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
                        {{ $i->user->name }} ({{$i->user->Roles[0]->name ?? ''}})
                    </span>
                </div>

{{--                @if( !empty($comment->addressedToUser->id) )--}}
{{--                    <div style="margin-left: -3px; margin-top:-6px;">--}}
{{--                            <span class="p-1 text-blue-400">--}}
{{--                                <svg class="inline h-4 w-4 text-blue-400"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>--}}
{{--                                 {{$comment->addressedToUser->name}}--}}
{{--                                ({{$comment->addressedToUser->Roles[0]->name}})--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                @endif--}}

                {{ $i->msg ?? '' }}
            </div>
        @endif
    </div>
</div>

