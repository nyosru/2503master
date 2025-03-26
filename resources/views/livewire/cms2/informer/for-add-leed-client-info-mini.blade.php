<div>

    @if( $client->physical_person == 'yes')
        <div class="bg-green-100 px-2 py-1">
            Физ.лицо
        </div>
    @else
        <div class="bg-blue-100 px-2 py-1">
            Юр.лицо
        </div>
    @endif
    <div class="flex flex-col text-sm">
        {{--        @foreach( $client->toArray() as $k=> $v )--}}

        {{--            @if( $client->physical_person == 'yes')--}}
        {{--                <div>{{ $k }}: {{ $v ?? '-'}}</div>--}}
        {{--            @else--}}
        {{--                <div>{{ $k }}: {{ $v ?? '-'}}</div>--}}
        {{--            @endif--}}

        ФИО: {{$client->name_f  ?? '-'}} {{$client->name_i  ?? '-'}} {{$client->name_o ?? '-'}}
        <br/>
        Тел: {{ !empty($client->phone) ? $client->phone : '-'}}
        E-mail: {{ !empty($client->email) ? $client->email : '-'}}
        <br/>
        extra_contacts: {{$client->extra_contacts ?? '-'}}
        <br/>
        Комментарий: {{$client->comment ?? '-'}}
        <br/>
        id: {{$client->id}} / Активный: {{$client->active ?? '-'}} /
        создан: {{ !empty($client->add_ts) ? date('d.m.y H:i',strtotime($client->add_ts)) : '-'}}
        <br/>
        @if( $client->physical_person == 'yes')
            <div class="bg-gray-100 ">Адрес</div>
            @if( !empty($client->address) )
                address: {{$client->address ?? '-'}}
            @endif
            <br/>
            @if( !empty($client->city) )
                {{$client->city ?? '-'}}
            @endif
            @if( !empty($client->street) )
                ул: {{$client->street ?? '-'}}
            @endif
            @if( !empty($client->building) )
                дом: {{$client->building ?? '-'}}/{{$client->building_part ?? '-'}}
            @endif
            @if( !empty($client->cvartira) )
                кв {{$client->cvartira ?? '-'}}
            @endif
            @if( !empty($client->floor) )
                этаж {{$client->floor ?? '-'}}
            @endif
            @if( !empty($client->lift) )
                Лифт {{$client->lift ?? '-'}}
            @endif
        @endif
        {{--        physical_person:--}}
        {{--        status: recom--}}
        {{--        forma:--}}
        {{--        avatar: avatar.png--}}
        @if( $client->physical_person != 'yes')
            <div class="bg-gray-100 ">Юр лицо</div>
            @if(!empty($client->ur_name))
                {{$client->ur_name ?? '-'}}
                <br/>
            @endif
            @if(!empty($client->name_company))
                {{$client->name_company ?? '-'}}
                <br/>
            @endif
            @if(!empty($client->ur_passport))
                {!! nl2br($client->ur_passport ?? '-' ) !!}
                <br/>
            @endif
        @endif
        @if( $client->physical_person == 'yes')
            <div class="bg-gray-100 ">Паспорт</div>

            {{$client->passport ?? '-'}}
            <br/>
            номер: {{$client->seria_passport ?? '-'}} {{$client->nomer_passport ?? '-'}}
            <br/>
            выдан: {{$client->date_passport ?? '-'}}
            <br/>
            код: {{$client->cod_passport ?? '-'}}
        @endif

    </div>
    {{--    <br/>--}}
    {{--    <br/>--}}
    {{--    <br/>--}}
    {{--    <pre>{{ print_r($client) }}</pre>--}}

</div>
