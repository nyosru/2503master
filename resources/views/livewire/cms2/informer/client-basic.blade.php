<div>
    @php
        $r = rand();
    @endphp

    {{--    $full: {{ var_dump($full) }}--}}

    <!-- Элемент, который будет переключать видимость блока -->
    @if( $full )
        <div style="cursor: pointer;"
             onclick="document.getElementById('info{{ $i->id . '_' . $r }}').classList.toggle('hidden');"
        >
            @endif
            @if($i->physical_person == 'yes')
                {{--            <i class="text-success bi bi-person-fill" title="Физик"></i>--}}
                <img src="/icon/bman.png" class="w-[24px] inline" title="Физик"/>
            @else
                <img src="/icon/briefcase.svg" class="w-[24px] inline" title="Компания"/>

                @if( !empty($i->ur_name) || !empty($i->name_company) )
                    @if( empty($i->name_company) && !empty($i->ur_name) )
                        {{$i->ur_name}}
                    @elseif( !empty($i->name_company) && empty($i->ur_name) )
                        {{$i->name_company}}
                    @elseif( strlen($i->name_company) != 0 && strlen($i->ur_name) > strlen($i->name_company) )
                        {{$i->name_company}}
                    @else
                        {{$i->ur_name}}
                    @endif
                    <br/>
                @endif
                {{--            <i class="text-danger bi bi-building" title="Компания"></i>--}}
                {{--            <svg title="Компания" class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">--}}
                {{--                <path fill="currentColor" d="M8 1V0v1Zm4 0V0v1Zm2 4v1h1V5h-1ZM6 5H5v1h1V5Zm2-3h4V0H8v2Zm4 0a1 1 0 0 1 .707.293L14.121.879A3 3 0 0 0 12 0v2Zm.707.293A1 1 0 0 1 13 3h2a3 3 0 0 0-.879-2.121l-1.414 1.414ZM13 3v2h2V3h-2Zm1 1H6v2h8V4ZM7 5V3H5v2h2Zm0-2a1 1 0 0 1 .293-.707L5.879.879A3 3 0 0 0 5 3h2Zm.293-.707A1 1 0 0 1 8 2V0a3 3 0 0 0-2.121.879l1.414 1.414ZM2 6h16V4H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v12h2V6h-2Zm0 12v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V6H0v12h2ZM2 6V4a2 2 0 0 0-2 2h2Zm16.293 3.293C16.557 11.029 13.366 12 10 12c-3.366 0-6.557-.97-8.293-2.707L.293 10.707C2.557 12.971 6.366 14 10 14c3.634 0 7.444-1.03 9.707-3.293l-1.414-1.414ZM10 9v2a2 2 0 0 0 2-2h-2Zm0 0H8a2 2 0 0 0 2 2V9Zm0 0V7a2 2 0 0 0-2 2h2Zm0 0h2a2 2 0 0 0-2-2v2Z"></path>--}}
                {{--            </svg>--}}
            @endif

            <a
{{--                href="{{ route('clients.info',['client_id'=>$i->id]) }}" --}}
                href="{{ route('clients.edit',['client_id'=>$i->id]) }}"
                wire:navigate class="link">
                {{ $i->name_f ?? '' }} {{ $i->name_i ?? '' }} {{ $i->name_o ?? '' }}
            </a>
            <sup>{{ $i->city != 'Тюмень' ? ($i->city ?? '') : '' }}</sup>
            @if( $full )
        </div>
    @endif
    {{--        <!-- Таблица, скрытая по умолчанию -->--}}
    @if( $full )
        <div class="hidden" id="info{{ $i->id . '_' . $r }}">
            <div class="card card-body rounded bg-orange-100 px-3" style="line-height: 2rem;">
                {{ $i->city }}
                <livewire:Informer.PhoneFormatter :phone="$i->phone" :key="$i->id.$r"/>
                @if(!empty($i->extra_contacts))
                    <br/>
                    Доп контакт:<br/>
                    {{ $i->extra_contacts }}
                @endif
                @if(!empty($i->email))
                    <br/>
                    <a href="mailto:{{ $i->email }}" class="text-blue-800 hover:underline">{{ $i->email }}</a>
                @endif
                <br/>
                <a href="{{ route('clients.info', ['id' => $i->id]) }}"
                   class="text-blue-800 hover:underline">Подробнее</a>
                <a href="{{ route('clients.info', ['id' => $i->id]) }}" target="_blank">
                    <img src="/icon/link_to_new_window.svg" class="w-[18px] inline" title="Открыть в новом окне"/>
                </a>
            </div>
        </div>
    @endif
</div>

{{--<div>--}}

{{--    @php--}}
{{--        $r = rand();--}}
{{--    @endphp--}}

{{--    --}}{{--    {{ $i->id.'_'.$r }}--}}
{{--    <div style="cursor: pointer;"--}}
{{--         --}}{{--         data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $i->id.'_'.$r }}" aria-expanded="false"--}}
{{--         --}}{{--         aria-controls="collapseExample"--}}
{{--         onclick="document.getElementById('info{{ $i->id.'_'.$r }}').classList.toggle('hidden');"--}}
{{--    >--}}
{{--        --}}{{--        class="toggle-block" xdata-target="#toggleTable-{{ $i->id.'_'.$r }}" --}}
{{--        --}}{{--         data-bs-toggle="collapse" data-bs-target="#toggleTable-{{ $r }}" aria-expanded="false" aria-controls="collapseExample"--}}
{{--        --}}{{--    >--}}

{{--        @if( $i->physical_person == 'yes' )--}}
{{--            <i class="text-success bi bi-person-fill" title="Физик"></i>--}}
{{--        @else--}}
{{--            <i class="text-danger bi bi-building" title="Компания"></i>--}}
{{--        @endif--}}

{{--        {{ $i->name_f ?? '' }}--}}
{{--        {{ $i->name_i ?? '' }}--}}
{{--        {{ $i->name_o ?? '' }}--}}

{{--        <sup>{{ $i->city != 'Тюмень' ? ( $i->city ?? '' ) : '' }}</sup>--}}

{{--    </div>--}}
{{--    --}}{{--<br/>--}}
{{--    --}}{{--    <pre>{{ print_r($i->toArray()) }}</pre>--}}

{{--    --}}{{--    <p class="d-inline-flex gap-1">--}}
{{--    --}}{{--        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--    --}}{{--            Ссылка с href--}}
{{--    --}}{{--        </a>--}}
{{--    --}}{{--        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $i->id.'_'.$r }}" aria-expanded="false" aria-controls="collapseExample">--}}
{{--    --}}{{--            Кнопка с data-target--}}
{{--    --}}{{--        </button>--}}
{{--    --}}{{--    </p>--}}

{{--    <!-- Таблица, скрытая по умолчанию -->--}}
{{--    <div class="        hidden--}}
{{--collapse" id="info{{ $i->id.'_'.$r }}">--}}
{{--        <div class="card card-body">--}}
{{--            {{ $i->city }}--}}
{{--            <br/>--}}
{{--            --}}{{--            Тел: {{ $i->phone }}--}}
{{--            <livewire:Informer.PhoneFormatter :phone="$i->phone" :key="$i->id.$r"/>--}}
{{--            @if( !empty($i->extra_contacts) )--}}
{{--                <br/>--}}
{{--                Доп контакт:<br/>--}}
{{--                {{ $i->extra_contacts }}--}}
{{--            @endif--}}
{{--            @if( !empty($i->email) )--}}
{{--                <br/>--}}
{{--                <a href="mailto:{{ $i->email }}">{{ $i->email }}</a>--}}
{{--            @endif--}}
{{--            <br/>--}}
{{--            &nbsp;--}}
{{--            <br/>--}}
{{--            <a style="float:right;" href="{{ route('clients.info',['id'=>$i->id]) }}">Подробнее</a>--}}

{{--            --}}{{--        <table id="toggleTable{{ $i->id.'_'.$r }}" class="table mt-3 d-none">--}}
{{--            --}}{{--        <thead>--}}
{{--            --}}{{--        <tr>--}}
{{--            --}}{{--            <th>Город</th><th>Колонка 2</th>--}}
{{--            --}}{{--            <th>Колонка 3</th>--}}
{{--            --}}{{--        </tr>--}}
{{--            --}}{{--        </thead>--}}
{{--            --}}{{--        <tbody>--}}
{{--            --}}{{--        <tr>--}}
{{--            --}}{{--            <td>Данные 1</td>--}}
{{--            --}}{{--            <td>Данные 2</td>--}}
{{--            --}}{{--            <td>Данные 3</td>--}}
{{--            --}}{{--        </tr>--}}
{{--            --}}{{--        <tr>--}}
{{--            --}}{{--            <td>Данные 4</td>--}}
{{--            --}}{{--            <td>Данные 5</td>--}}
{{--            --}}{{--            <td>Данные 6</td>--}}
{{--            --}}{{--        </tr>--}}
{{--            --}}{{--        <tr>--}}
{{--            --}}{{--            <td>Данные 7</td>--}}
{{--            --}}{{--            <td>Данные 8</td>--}}
{{--            --}}{{--            <td>Данные 9</td>--}}
{{--            --}}{{--        </tr>--}}
{{--            --}}{{--        </tbody>--}}
{{--            --}}{{--    </table>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    --}}{{--    <pre>{{ print_r($i) }}</pre>--}}

{{--</div>--}}
