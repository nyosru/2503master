<div class="container mx-auto">
    <div>
        <livewire:Cms2.App.Breadcrumb
            :board_id="$board->id"
            :menu="[
                        ['route'=>'leed.list','name'=>'Рабочие доски'],
                        [
                            'route'=>'leed',
{{--                            'route-var'=>['board_id'=>$board->id ?? ''],--}}
                                'name'=> $board->name
    {{--                                        'name'=>( $user->currentBoard->name ?? 'x' ).( $user->roles[0]['name'] ? ' <sup>'.$user->roles[0]['name'].'</sup>' : '-' )--}}
                        ],

                        [
                        'route'=>'board.config',
{{--                        'route-var'=>['board'=>$board->id ?? ''],--}}
                        'route-var'=>['board'=>$board ?? ''],
                        'name'=>'Конфигурация',
{{--                        'link'=>'no'--}}
                        ],

                        [
                        'name'=>'Настройки полей',
                        'route'=>'board.config.polya',
                        'route-var'=>['board'=>$board ?? ''],
                        'link'=>'no'
                        ],
                    ]"/>
    </div>

    <livewire:board.field-settings :boardId="$board->id" />

</div>
