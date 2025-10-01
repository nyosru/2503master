<div class="container mx-auto">

    <div>
        <livewire:Cms2.App.Breadcrumb
            :board_id="$board->id"
            :menu="[
                        ['route'=>'board.list','name'=>'Рабочие доски'],
                        [
                            'route'=>'board.show',
                            'route-var'=>['board_id'=>$board->id ?? ''],
                            'name'=> $board->name
{{--                                            'name'=>( $user->currentBoard->name ?? 'x' ).( $user->roles[0]['name'] ? ' <sup>'.$user->roles[0]['name'].'</sup>' : '-' )--}}
                        ],

                        [
                        'route'=>'leed',
                        'name'=>'Конфигурация',
                        'link'=>'no'
                        ],

                    ]"/>
    </div>

    <div class="flex flex-row">

        <div class="flex flex-col w-[250px]">

            @foreach( $buttons as $key => $b )
                <button
                    wire:click="$set('activeTab', '{{ $key }}' )"
                    :key="$key"
                    class="px-4 py-2 {{ $activeTab === $key ? 'bg-blue-500 text-white' : 'bg-gray-300' }}"
                >{{ $b['name'] }}</button>
            @endforeach

        </div>

        <div class="flex-1">

            @if ( !empty($buttons[$activeTab]['template']) )
                @livewire($buttons[$activeTab]['template'], ['board' => $board ], key($board->id.' '.$activeTab))
            @endif

        </div>
    </div>

</div>
