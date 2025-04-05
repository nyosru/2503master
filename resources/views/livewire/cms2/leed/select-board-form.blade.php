<div>
    @if( !empty($user->boardUser) && count($user->boardUser) > 1 )
        Выберите рабочую доску:
        @foreach( $user->boardUser as $v )
            <button class="bg-blue-200 m-1 py-1 px-2 rounded"
                    wire:click="setCurrentBoard({{$v->board->id}})">{{ $v->board->name }}</button>
            {{--            <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($v->toArray()) }}</pre>--}}
        @endforeach
    @endif
</div>
