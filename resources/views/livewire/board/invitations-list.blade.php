<div>
    {{-- Success is as dangerous as failure. --}}
{{--    <pre class="text-xs">{{print_r($invitations->toArray())}}</pre>--}}
{{--    @foreach($invitations as $invitation)--}}
{{--        <div class="bg-white border rounded-lg px-6 py-4 shadow-md">--}}
{{--            {{$invitation->phone}} + {{$invitation->role->name}}--}}
{{--            @if($show_button_enter)--}}
{{--                кнопа войти--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    @endforeach--}}

    @if (session()->has('inviteMessage'))
        <div class="my-4 p-4 bg-green-300 text-black font-bold rounded">
            {{ session('inviteMessage') }}
        </div>
    @endif

    @if (session()->has('inviteWarning'))
        <div class="my-4 p-4 bg-red-300 text-black font-bold rounded">
            {{ session('inviteWarning') }}
        </div>
    @endif

    @if(sizeof($invitations) >0)
        <div class="mb-5">
            <h2 class="text-lg font-bold my-2">Есть приглашения в рабочие доски, заходите:</h2>
            {{--                <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($invite->toArray()) }}</pre>--}}

            <div class="ml-4">
                @foreach($invitations as $inv)
                    <span class="bg-blue-200 rounded p-3 rounded m-1">{{ $inv->board->name }}
                            > {{ $inv->role->name}}
{{--                            <button --}}
{{--                                    wire:click="{{ route('board.invitations.join',  $inv->id ) }}"--}}
{{--                            >Войти</button>--}}
                            <a href="{{ route('board.invitations.join',  $inv->id ) }}"
                               class="bg-blue-500 text-white rounded py-1 px-2 rounded"
                            >Войти</a>
                        </span>
                @endforeach
            </div>

        </div>
    @endif

</div>
