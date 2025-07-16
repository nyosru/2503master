<div>

    @if(1==2)
        <pre
            class="
                max-h-[200px]
                text-xs
                overflow-auto
                ЭЮХХ зкште_к(;шеуь) ЪЪБ.зкуЮ
ву    @endif

    @if( $item['type'] == 'on_pause_to_move' )
        <div class="bg-orange-100 mb-2 rounded p-2">
            @if( $item['name'] )
                <b>{{ $item['name'] ?? '-'  }}</b>
            @endif
            @if($item['comment'])
                <br/>
                {{ $item['comment'] ?? '-'  }}
            @endif
            <div class="pl-[2vw]">
                <b>если:</b> запись стоит без действий и комментариев <u
                    class="bg-blue-200 py-1 px-2 rounded">{{ $item['day'] ?? '-' }}</u> дня(ей)
                <br/>
                <b>то:</b> Отправить запись в <u
                    class="bg-blue-200 py-1 px-2 rounded">{{ $item['move_to_column_data']['name'] ?? '-'  }}</u>
            </div>
        </div>
    @endif

</div>
