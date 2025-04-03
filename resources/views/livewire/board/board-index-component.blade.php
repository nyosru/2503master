<div>

    смотрим данные
    <pre>{{ print_r($user_now->toArray()) }}</pre>

    @if( empty($user_now->current_board) )
        пустая
    @else
        не пустая
    @endif

</div>
