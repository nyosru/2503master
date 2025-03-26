<div>

    <div class="app-content-header">
        <livewire:Cms2.App.Breadcrumb :menu="[
            ['route'=>'order.index','name'=>'Заказы'],
            ['link'=>'no','name'=>'Заказ #'.$order_id],
        ]"/>
    </div>

    <pre class="text-xs">{{ print_r($order->toArray()) }}</pre>
    {{--    <pre>{{ print_r($order->toArray()) }}</pre>--}}

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Ключ</th>
            <th>Значение</th>
        </tr>
        </thead>
        <tbody>

        @foreach($order->toArray() as $key => $value)
            @if( is_array($value) )

                <tr>
                    <td>++ {{ $key }}</td>
                    <td>&nbsp;</td>
                </tr>
{{--                @foreach($value as $key1 => $value1)--}}
{{--                    @if( is_array($value1) )--}}

{{--                    @else--}}
{{--                        <tr>--}}
{{--                            <td>++ ++ {{ $key1 }}</td>--}}
{{--                            <td>{{ $value1 }}</td>--}}
{{--                        </tr>--}}
{{--                    @endif--}}
{{--                @endforeach--}}

            @else
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endif
        @endforeach



        {{--        @foreach($order->toArray() as $key => $value)--}}
        {{--        @foreach($order->getAttribute() as $key => $value)--}}
        {{--                            <tr><td>{{ $key }}</td><td>{{ $value }}</td></tr>--}}
        {{--            @if(is_array($value))--}}
        {{--                --}}{{----}}{{-- Если значение является массивом, отображаем его рекурсивно --}}
        {{--                @php--}}
        {{--                    $arrayValue = json_encode($value, JSON_PRETTY_PRINT);--}}
        {{--                @endphp--}}
        {{--                <tr><td>{{ $key }}</td><td><pre>{{ $arrayValue }}</pre></td></tr>--}}
        {{--            @else--}}
        {{--                --}}{{----}}{{-- Если значение не является массивом, отображаем напрямую --}}
        {{--                <tr><td>{{ $key }}</td><td>{{ $value }}</td></tr>--}}
        {{--            @endif--}}
        {{--        @endforeach--}}
        </tbody>
    </table>

</div>
