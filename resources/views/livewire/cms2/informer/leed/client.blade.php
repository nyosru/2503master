<div
    class="
        flex-auto
        rounded
{{--        xpx-1 xpy-1 xml-3 --}}
        inline
         bg-white border-2 border-gray-200
{{--         w-[35px]--}}
{{--         h-[35px]--}}
         h-[28px]
         overflow-hidden
         flex items-center
         justify-center
         "
>
    {{--    кл--}}
    {{--    {{ $ordersCount ?? '-' }}--}}
    {{--    <pre class="text-xs">{{ print_r($ordersCount->toArray()) }}</pre>--}}
    {{--    <pre class="text-xs max-h-[100px] overflow-auto">{{ print_r($leed->toArray()) }}</pre>--}}

    @if( !empty($leed->client_id) )

        {{--        <div>--}}
        <a
            {{--                                                        href="{{ config('custom.mf_client_info').$leed->client_id }}"--}}
            {{--                                                        href="{{ route('clients.info', ['client_id' => $leed->client_id ]) }}"--}}
            href="{{ route('clients.edit', ['client_id' => $leed->client_id ]) }}"
            wire:navigate

            title="Клиент: {{ $leed->client->name_f }} {{ $leed->client->name_i }} ({{ $leed->client->physical_person == 'yes' ? 'физик' : 'Юрик' }})"
{{--            class="inline bg-white p-1 rounded"--}}
        >

            @if( $leed->client->physical_person == 'yes' )
            <svg class="h-5 w-5 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            @else

{{--                <svg class="h-6 w-6 text-orange-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
{{--                </svg>--}}
                <svg class="h-5 w-5 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="3" y1="21" x2="21" y2="21" />  <line x1="9" y1="8" x2="10" y2="8" />  <line x1="9" y1="12" x2="10" y2="12" />  <line x1="9" y1="16" x2="10" y2="16" />  <line x1="14" y1="8" x2="15" y2="8" />  <line x1="14" y1="12" x2="15" y2="12" />  <line x1="14" y1="16" x2="15" y2="16" />  <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>

            @endif


            {{--            <img--}}
{{--                @if( $leed->client->physical_person == 'yes' )--}}
{{--                    src="/icon/client.png"--}}
{{--                @else--}}
{{--                    src="/icon/briefcase.svg"--}}
{{--                @endif--}}
{{--                class="w-6 inline-block"/>--}}

        </a>
        {{--        </div>--}}
    @else
        {{--        <div>--}}
        <abbr title="Создайте/выберите клиента">
            <a href="{{ route('clients.create', ['return_url' => 'leed', 'return_leed' => $leed->id  ]) }}"
               wire:navigate
{{--               class="inline-block bg-white p-1 rounded font-bold text-green-500"--}}
            >
{{--                <img src="/icon/client.blank.png"--}}
{{--                     class="w-6 inline-block"/>--}}
{{--                <svg class="h-6 w-6 text-neutral-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>--}}
{{--                </svg>--}}
                <svg class="h-5 w-5 text-blue-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>

            </a>
        </abbr>
        {{--        </div>--}}
    @endif

</div>
