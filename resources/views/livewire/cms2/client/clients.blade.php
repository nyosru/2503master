<div>
    <div class="container mx-auto">

        <div class="app-content-header"> <!--begin::Container-->
            <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'clients','name'=>'Клиенты']]"/>
        </div>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        {{--        return_url: {{ $return_url }}--}}
        {{--        / return_leed: {{ $return_leed }}--}}
        {{--        <a href="{{ route('clients', ['return_url' => 'leed', 'return_leed' => $record->id  ]) }}"--}}

        {{--            если делаем клиента для лида--}}
        @if($return_url == 'leed')
            <div class="text-center m-3">
                <a href="{{ route('clients.create', ['return_url' => 'leed', 'return_leed' => $return_leed  ]) }}"
                   class="bg-orange-300 p-2 rounded mr-3"
                   wire:navigate>
                    Создать нового клиента
                </a> или выбрать текущего (форма ниже)
            </div>
        @endif

        <div class="px-3 flex flex-col space-y-2">

            <div class="w-full text-right xmb-2 p-2">

                @if( empty($return_url ) )
                    <a href="{{ route('clients.create') }}" wire:navigate
                       class="bg-orange-300 rounded hover:shadow px-2 py-1">Создать</a>
                @endif

                <form class="ml-[10px] inline-block float-left" wire:submit.prevent="goSearch">

                    @if( !empty($searchTerm) )
                        <span class="bg-yellow-400 px-2 py-2">
                    Поиск: {{ $searchTerm }}
                        </span>
                    @endif

                    <input type="text"
                           wire:model="searchTerm"
                           placeholder="Поиск"
                           class="shadow appearance-none border rounded w-[150px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-0"/>
                    <button type="submit" class="bg-gray-400 px-2 py-1 ml-[-3px]">Искать</button>
                </form>
            </div>

            <div class="px-3 ">
                <div class="overflow-x-auto">
                    <div class="flex flex-col sticky sticky-top">
                        <!-- Header Row -->
                        <div class="flex text-sm font-semibold text-gray-700 bg-gray-200 p-2">

                            {{--                        <div class="flex-1 text-center">id</div>--}}
                            <div class="flex-1 text-center">
                                {{--                                name_i name_f name_o--}}
                                ФИО
                            </div>
                            @if( !empty($return_url) )
                                <div class="flex-1 text-center">
                                    Выбрать
                                </div>
                            @endif

                            <div class="flex-1 text-center">
                                Телефон
                                {{--                                phone / extra_contacts / E-mail--}}
                            </div>
                            <div class="flex-1 text-center">E-mail</div>
                            <div class="flex-1 text-center">Доп. контакты</div>
                            <div class="flex-1 text-center">Комментарий</div>
                            <div class="flex-1 text-center">Добавлен</div>

                            {{--                            <div class="flex-1 text-center">address</div>--}}

                            {{--                            <div class="flex-1 text-center">--}}
                            {{--                                city / street / building / building_part / cvartira--}}
                            {{--                                / floor--}}
                            {{--                                / lift--}}
                            {{--                            </div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">floor</div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">lift</div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">email</div>--}}
                            {{--                            <div class="flex-1 text-center">comment</div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">physical_person</div>--}}
                            {{--                            <div class="flex-1 text-center">status</div>--}}
                            {{--                            <div class="flex-1 text-center">forma</div>--}}
                            {{--                            <div class="flex-1 text-center">avatar</div>--}}
                            {{--                            <div class="flex-1 text-center">--}}
                            {{--                                passport / seria_passport / nomer_passport / date_passport / cod_passport--}}
                            {{--                            </div>--}}

                            {{--                            <div class="flex-1 text-center">name_company--}}
                            {{--                                / ur_passport--}}
                            {{--                                / ur_name--}}
                            {{--                            </div>--}}

                            {{--                            --}}{{--                        <div class="flex-1 text-center">name_company</div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">ur_passport</div>--}}
                            {{--                            --}}{{--                        <div class="flex-1 text-center">ur_name</div>--}}
                            {{--                            <div class="flex-1 text-center">active</div>--}}
                        </div>
                        <!-- Data Rows -->
                        @if(isset($items) && count($items) > 0)
                            @foreach($items as $key => $cl)
                                <div class="flex text-sm p-2 {{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                    {{--                                <div class="flex-1 text-center">{{ $cl->id ?? '-' }}</div>--}}
                                    <div class="flex-1 text-center">
                                        <livewire:cms2.informer.client-basic :i="$cl" :key="$cl->id" :full="false"/>
                                    </div>

                                    @if( !empty($return_url) )
                                        <div class="flex-1 text-center">
                                            <a href="{{ route('leed',['return_leed' => $return_leed, 'client_to_leed' => $cl->id ]) }}"
                                               wire:navigate
                                               class="bg-orange-300 p-2 rounded">Выбрать</a>
                                        </div>
                                    @endif

                                    <div class="flex-1 text-center">
                                        <livewire:Informer.PhoneFormatter :phone="$cl->phone" :key="$cl->id"/>
                                    </div>
                                    <div class="flex-1 text-center">
                                        @if( !empty($cl->email) )

                                            <livewire:Informer.EmailFormatter :email="$cl->email"
                                                                              :key="'email'.$cl->id"/>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="flex-1 text-center">
                                        {{ $cl->extra_contacts ?? '-' }}
                                    </div>
                                    <div class="flex-1 text-center">
                                        {{ !empty($cl->comment) ? $cl->comment : '-' }}
                                    </div>
                                    <div class="flex-1 text-center">
                                        {{--                                        @formatDate($cl->add_ts)--}}
                                        {{ $cl->add_ts ? \Carbon\Carbon::parse($cl->add_ts)->format('d.m.y') : '-' }}
                                    </div>

                                    @if(1==2)

                                        <div class="flex-1 text-center">
                                            {{ $cl->add_ts ? \Carbon\Carbon::parse($cl->add_ts)->format('d.m.y') : '-' }}
                                        </div>
                                        <div class="flex-1 text-center">{{ $cl->address ?? '-' }}</div>
                                        <div class="flex-1 text-center">
                                            {{ $cl->city ?? '-' }} /
                                            {{ $cl->street ?? '-' }} /
                                            {{ $cl->building ?? '-' }} /
                                            {{ $cl->building_part ?? '-' }} /
                                            {{ $cl->cvartira ?? '-' }}
                                            / @if( !empty($cl->floor))
                                                Этаж: {{ $cl->floor ?? '-' }}
                                            @else
                                                -
                                            @endif
                                            / @if( !empty($cl->lift))
                                                Лифт: {{ $cl->lift ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        {{--                                <div class="flex-1 text-center">{{ $cl->floor ?? '-' }}</div>--}}
                                        {{--                                <div class="flex-1 text-center">{{ $cl->lift ?? '-' }}</div>--}}
                                        {{--                                <div class="flex-1 text-center">{{ $cl->email ?? '-' }}</div>--}}
                                        <div class="flex-1 text-center">{{ $cl->comment ?? '-' }}</div>
                                        {{--                                <div class="flex-1 text-center">{{ $cl->physical_person ?? '-' }}</div>--}}
                                        <div class="flex-1 text-center">{{ $cl->status ?? '-' }}</div>
                                        <div class="flex-1 text-center">{{ $cl->forma ?? '-' }}</div>
                                        <div class="flex-1 text-center">{{ $cl->avatar ?? '-' }}</div>
                                        <div class="flex-1 text-center">
                                            {{ $cl->seria_passport ?? '-' }} {{ $cl->nomer_passport ?? '-' }}

                                            <a href="#">подробнее</a>

                                            <div class="hidden">
                                                {{ $cl->passport ?? '-' }} /
                                                {{ $cl->seria_passport ?? '-' }} /
                                                {{ $cl->nomer_passport ?? '-' }} /
                                                {{ $cl->date_passport ?? '-' }} /
                                                {{ $cl->cod_passport ?? '-' }}
                                            </div>

                                        </div>
                                        <div class="flex-1 text-center">

                                            {{ $cl->ur_name ?? '-' }}
                                            <br/>
                                            {{ $cl->name_company ?? '-' }}
                                            <a href="#">подробнее</a>

                                            <div class="hidden">

                                                {{ $cl->ur_passport ?? '-' }}

                                            </div>
                                        </div>
                                        {{--                                <div class="flex-1 text-center">{{ $cl->ur_passport ?? '-' }}</div>--}}
                                        {{--                                <div class="flex-1 text-center">{{ $cl->ur_name ?? '-' }}</div>--}}
                                        {{--                                <div class="flex-1 text-center">{{ $cl->name_company ?? '-' }}</div>--}}
                                        <div class="flex-1 text-center">{{ $cl->active ?? '-' }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="flex text-center p-4 bg-yellow-100">
                                <div class="flex-1">Не найдено данных, поиск: <u>{{ $searchTerm }}</u></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container mx-auto mt-3">
                {{--                {{ $items->onEachSide(2)->links('pagination::tailwind') }}--}}
                {{ $items->withQueryString()->onEachSide(2)->links('pagination::tailwind') }}
                {{--                {{ $items->onEachSide(2)->links() }}--}}
                {{--                {{ $items->links('pagination::tailwind') }}--}}
            </div>

        </div>
    </div>
</div>
