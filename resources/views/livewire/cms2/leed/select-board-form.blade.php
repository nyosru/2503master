<div>
    @if( !empty($user->boardUser) && count($user->boardUser) > 1 )
        Выберите рабочую доску:
        @foreach( $user->boardUser as $v )
            <button class="
            @if( $v->board->id == $user->current_board_id )
              underline font-bold
            @else
            hover:underline
            @endif

bg-blue-100 hover:bg-blue-200
            mr-1 py-1 px-2 rounded"
                    wire:click="setCurrentBoard({{$v->board->id}})">{{ $v->board->name }} <sup>{{ $v->role->name }}</sup></button>
{{--            <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($v->toArray()) }}</pre>--}}
        @endforeach
    @else
        <h2 class="text-lg font-bold">Создать рабочую доску</h2>
        <form action="" method="post" class="m-2" wire:submit="store">
            <input type="text" wire:model="name" class="rounded-xl px-2" required/>
            <button type="submit" class="bg-blue-300 p-1 rounded">Создать</button>
        </form>
    @endif

{{--        <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($user->toArray()) }}</pre>--}}

</div>
