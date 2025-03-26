<div class="">
    <div class="container mx-auto w-[96%]">

        {{-- Breadcrumb and header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'staff.index','name'=>'Сотрудники']]"/>
                    </div>
                </div>
            </div>
        </div>

        @if( !empty($position) )
            <div class="bg-warning p-2">
                Показаны позиции с Должностью: {{$position}}
                <a href="{{ route('staff.index') }}" class="float-end" wire:navigate>отменить фильтр</a>
            </div>
        @endif

        <!-- Flexbox Table -->
        <div class="overflow-x-auto">
            <div class="flex flex-col">
                <div class="flex text-sm font-semibold text-gray-700 bg-gray-200 p-2">
                    <div class="flex-1">Должность</div>
                    <div class="flex-1">ФИО</div>
                    <div class="flex-1">Телефон</div>
                    <div class="flex-1">E-mail</div>
                    <div class="flex-1">Д.Р.</div>
                    @if( $show_all_info )
                        <div class="flex-1">telegram_chat_id</div>
                        <div class="flex-1">have_telegram_access</div>
                        <div class="flex-1">have_crm_access</div>
                        <div class="flex-1">address</div>
                        <div class="flex-1">is_chief</div>
                        <div class="flex-1">is_manager</div>
                        <div class="flex-1">access_table</div>
                        <div class="flex-1">access_regedit</div>
                        <div class="flex-1">access_leads</div>
                        <div class="flex-1">access_accounting</div>
                        <div class="flex-1">access_schedule</div>
                        <div class="flex-1">access_contracts</div>
                        <div class="flex-1">status</div>
                        <div class="flex-1">access_orders</div>
                        <div class="flex-1">access_clients</div>
                        <div class="flex-1">access_staff</div>
                        <div class="flex-1">access_providers</div>
                        <div class="flex-1">access_warehouse</div>
                        <div class="flex-1">access_supply</div>
                        <div class="flex-1">access_services</div>
                        <div class="flex-1">role</div>
                        <div class="flex-1">style</div>
                        <div class="flex-1">menu</div>
                        <div class="flex-1">avatar</div>
                        <div class="flex-1">config</div>
                        <div class="flex-1">access_orders_all</div>
                        <div class="flex-1">access_files</div>
                        <div class="flex-1">access_fittings</div>
                        <div class="flex-1">access_tfmf</div>
                    @endif
                </div>

                <div class="overflow-y-auto">
                    @if( isset($items) && count($items) == 0 )
                        <div class="text-center bg-warning p-3 text-xl">
                            Не найдено данных, поиск: <u>{{ $searchTerm }}</u>
                        </div>
                    @else
                        @foreach($items as $i)

{{--                            <pre>{{ print_r($i->toArray()) }}</pre>--}}

                            <div class="flex text-sm bg-white border-t">
                                <div class="flex-1 p-2">
                                    @if( empty($position) )
                                        <a href="{{ route('staff.index', ['page'=> 1 , 'position' => ($i->department ?? '-' ) ] ) }}" wire:navigate>
                                            {{ $i->department ?? '-' }}
                                        </a>
{{--                                    @else--}}
{{--                                        {{ $i->department ?? '-' }}--}}
                                    @endif


                                </div>
                                <div class="flex-1 p-2">{{ $i->name ?? '-' }}</div>
                                <div class="flex-1 p-2">
                                    <livewire:Informer.PhoneFormatter :phone="$i->phone" :key="$i->id" wire:lazy/>
                                </div>
                                <div class="flex-1 p-2">
                                    @if( !empty( $i->email ) )
                                        <a href="mailto:{{ $i->email }}">{{ $i->email }}</a>
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="flex-1 p-2">{{ $i->date ?? '-' }}</div>

                                @if( $show_all_info )
                                    <div class="flex-1 p-2">{{ $i->telegram_chat_id ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->have_telegram_access ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->have_crm_access ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->address ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->is_chief ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->is_manager ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_table ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_regedit ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_leads ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_accounting ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_schedule ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_contracts ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->status ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_orders ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_clients ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_staff ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_providers ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_warehouse ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_supply ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_services ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->role ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->style ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->menu ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->avatar ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->config ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_orders_all ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_files ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_fittings ?? '-' }}</div>
                                    <div class="flex-1 p-2">{{ $i->access_tfmf ?? '-' }}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="container mx-auto pt-2">
            {{ $items->onEachSide(2)->links('pagination::tailwind') }}
        </div>

    </div>
</div>
