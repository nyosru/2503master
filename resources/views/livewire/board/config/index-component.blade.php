<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :board_id="$board->id"
            :menu="[
                        ['route'=>'leed.list','name'=>'Рабочие доски'],
                        [
                            'route'=>'leed',
                            'route-var'=>['board_id'=>$board->id ?? ''],
                            'name'=> $board->name
    {{--                                        'name'=>( $user->currentBoard->name ?? 'x' ).( $user->roles[0]['name'] ? ' <sup>'.$user->roles[0]['name'].'</sup>' : '-' )--}}
                        ],

                        [
                        'route'=>'leed',
                        'name'=>'Конфигурация',
                        'link'=>'no'
                        ],

                    ]"/>
    </div>


    <br/>
    <br/>

    <a href="{{ route('board.config.polya',['board'=>$board]) }}"
        class="inline bg-blue-300 px-[30px] py-[20px] rounded m-1"
        >Настройки полей</a>

    <a href="{{ route('board.config.macros',['board'=>$board]) }}"
        class="inline bg-blue-300 px-[30px] py-[20px] rounded m-1"
        >Автодействия (макросы)</a>
    <br/>

{{--    <a href="{{ route() }}">Настройки полей</a>--}}


</div>
