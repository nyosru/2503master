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

            @if(1==2)
                {{--            <a href="{{ route('board.config.polya',['board'=>$board]) }}"--}}
                {{--               class="inline bg-blue-300 px-[30px] py-[20px] rounded m-1"--}}
                {{--            >базовые настройки</a>--}}

                <button wire:click="$set('activeTab', 'base')"
                        class="px-4 py-2 {{ $activeTab === 'base' ? 'bg-blue-500 text-white' : 'bg-gray-300' }}"
                >
                    Базовые настройки
                </button>

                <button
                    {{--                href="{{ route('board.config.polya',['board'=>$board]) }}"--}}
                    wire:click="$set('activeTab', 'polya')"
                    class="px-4 py-2 {{ $activeTab === 'polya' ? 'bg-blue-500 text-white' : 'bg-gray-300' }}"

                >Настройки полей
                </button>

                {{--    <a href="{{ route('board.config.macros',['board'=>$board]) }}"--}}
                {{--        class="inline bg-blue-300 px-[30px] py-[20px] rounded m-1"--}}
                {{--        >Автодействия (макросы)</a>--}}
                {{--    <br/>--}}

                {{--    <a href="{{ route() }}">Настройки полей</a>--}}
            @endif

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
{{--                tpl: {{$buttons[$activeTab]['template']}}--}}
                @livewire($buttons[$activeTab]['template'], ['board' => $board ], key($board->id.' '.$activeTab))
            @endif

            {{--            @if ($activeTab === 'base')--}}
            {{--            <livewire:board.config.user-settings :board="$board"/>--}}
            {{--            @elseif ($activeTab === 'fields')--}}
            {{--                <livewire:board.config.polya-component :board="$board"/>--}}
            {{--            @endif--}}

        </div>
    </div>

</div>
