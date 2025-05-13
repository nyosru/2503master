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

    <livewire:board.field-settings :boardId="$board->id" />


{{--    <pre class="text-xs">{{ print_r($board) }}</pre>--}}
{{--    <pre class="text-xs">{{ print_r($cfg_polya) }}</pre>--}}
{{--    $cfg_polya_data--}}
{{--    <pre class="text-xs">{{ print_r($cfg_polya_data->toArray()) }}</pre>--}}



{{--<hr>--}}
{{--<hr>--}}
{{--<hr>--}}
{{--<hr>--}}
{{--<hr>--}}


{{--    <table>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <td>поле</td>--}}
{{--            <td>вкл?</td>--}}
{{--            <td>показывать на главном поле</td>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tboady>--}}
{{--            @foreach($board->getAttributes() as $f)--}}
{{--            <tr>--}}
{{--                <td>{{ $f ?? '-'  }}</td>--}}
{{--                <td>вкл?</td>--}}
{{--                <td>показывать на главном поле</td>--}}
{{--            </tr>--}}
{{--                @endforeach--}}


{{--            @foreach($leed1->getAttributes() as $k => $f)--}}
{{--                    @if( isset($cfg_polya[$k]) )--}}
{{--            <tr>--}}
{{--                <td>{{ $k ?? '-'  }}</td>--}}
{{--                <td>{{ $f ?? '-'  }}</td>--}}
{{--                <td>вкл?</td>--}}
{{--                <td>показывать на главном поле</td>--}}
{{--            </tr>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--        </tboady>--}}
{{--    </table>--}}

</div>
