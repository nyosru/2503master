<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.service.dadata_org_search_component','name'=>'Поиск данных по ИНН'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <form wire:submit.prevent="search" class="mb-4">
        <input type="text" wire:model="inn" placeholder="Введите ИНН" class="border rounded p-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Найти</button>
    </form>

    @if( !empty($inn) )
        {{-- Индикатор загрузки --}}
        {{--        <div wire:loading wire:target="search" class="mb-4 text-blue-600 font-semibold">--}}
        {{--            Загрузка...--}}
        {{--        </div>--}}

        @if($error)
            <div class="text-red-600 mb-2">{{ $error }}</div>
        @endif

        @if($orgData)
            <div class="p-4 bg-gray-100 rounded">

                {{--            <pre class="max-h-[200px] overflow-auto">{{ print_r($orgData,1) }}</pre>--}}

                @foreach( $orgData as $k => $v )
                    @if( !is_array($v) )
                        <div><b>{{ $k }}:</b> {{ $v ?? '-' }}</div>
                    @else
                        <div class="ml-4">
                            <br/>
                            <b>{{ $k }}</b><br/>
                            @foreach( $v as $k1 => $v1 )
                                @if( !is_array($v1) )
                                    <div class="ml-4"><b>{{ $k1 }}:</b> {{ $v1 ?? '-' }}</div>
                                @else
                                    <div class="ml-4">
                                        <br/>
                                        <b>{{ $k1 }}</b><br/>
                                        @foreach( $v1 as $k2 => $v2 )
                                            @if( !is_array($v2) )
                                                <div class="ml-4"><b>{{ $k2 }}:</b> {{ $v2 ?? '-' }}</div>
                                            @else
                                                <div class="ml-4">
                                                    <br/>
                                                    <b>{{ $k2 }}</b><br/>
                                                    @foreach( $v2 as $k3 => $v3 )
                                                        @if( !is_array($v3) )
                                                            <div class="ml-4"><b>{{ $k3 }}:</b> {{ $v3 ?? '-' }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
                {{--            <div><b>Название:</b> {{ $orgData['name']['full_with_opf'] ?? '-' }}</div>--}}
                {{--            <div><b>ИНН:</b> {{ $orgData['inn'] ?? '-' }}</div>--}}
                {{--            <div><b>ОГРН:</b> {{ $orgData['ogrn'] ?? '-' }}</div>--}}
                {{--            <div><b>Адрес:</b> {{ $orgData['address']['value'] ?? '-' }}</div>--}}
                {{-- Добавьте другие поля, если нужно --}}
            </div>
        @endif
    @endif

</div>
