<div>
    {{--    form user board role--}}
    {{-- Stop trying to control. --}}
{{--        <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($user->toArray()) }}</pre>--}}

    @if( !empty($user->boardUser) )
        @foreach( $user->boardUser as $b )
            {{--                <option>{{$b->board->name}} ({{$b->role->name}})</option>--}}
{{--            wire:click="setBoardRole({{$user->id ?? 'x'}},{{$b->board->id ?? 'x'}}, {{$b->role->id ?? 'x'}})"--}}
            <button
{{--                wire:click="setBoardRole({{$user->id}},{{$b->board->id}}, {{$b->role->id}})"--}}
                class="block mb-1 rounded p-1 @if( !empty($b->board->id) && $b->board->id == $user->current_board_id && $b->role->id == $user->roles[0]->id ) bg-blue-500 @else bg-blue-300  @endif "
            >
                {{$b->board->name ?? '-'}} ({{$b->role->name}})
            </button>

            {{--            <pre>{{ print_r($b->toArray()) }}</pre>--}}
        @endforeach
    @endif
</div>
