<div>
    <div class="container mx-auto">

        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="flex flex-wrap justify-between">

                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0">
                        <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'buh.zakazs','name'=>'Бухгалтерия'],[ 'link'=>'no', 'name'=>'Заказы']]" />
                    </div>

                    <div class="w-full sm:w-1/2">
                        <input type="text" wire:model.live="searchTerm" placeholder="Поиск по клиенту ..."
                               class="form-control w-full p-2 border rounded">
                    </div>

                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header-->

    </div>

    <div class="px-3">
        <!-- Table with orders and clients -->
        <table class="table w-full text-sm">

            <thead>
            <tr class="bg-gray-300 font-bold">
                <th scope="col" class="text-center py-2">№<br/>заказа</th>
                <th scope="col" class="text-center py-2">Дата<br/>создания</th>
                <th scope="col" class="text-center py-2">ФИО Клиента</th>
                <th scope="col" class="text-end py-2">Цена</th>
                <th scope="col" class="text-end py-2">Выручка</th>
                <th scope="col" class="text-end py-2">Камень<br/>Фасады</th>
                <th scope="col" class="text-end py-2">Фурнитура<br/>Работы</th>
                <th scope="col" class="text-end py-2">Монтаж<br/>Сборка</th>
                <th scope="col" class="text-end py-2">Замер</th>
                <th scope="col" class="text-end py-2">Доставка<br/>Грузчики</th>
                <th scope="col" class="text-end py-2">Менеджер<br/>Скидка</th>
                <th scope="col" class="text-end py-2">Доп заказ</th>
                <th scope="col" class="text-end py-2 pr-1">Дизайн<br/>Технолог</th>
            </tr>
            </thead>

            <tbody>
            @if( isset($items) && count($items) == 0 )
                <tr>
                    <td colspan="13" class="text-center bg-warning py-2" style="font-size:1rem">
                        Не найдено данных, поиск: <u>{{ $searchTerm }}</u>
                    </td>
                </tr>
            @else
                @foreach($items as $key => $order)
                    <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-t">
                        <td class=" py-2">
                            @if( $order->service == "A" )
                                <a href="https://crm.marudi.store/fabcrm/page/order_info?service_id={{ $order->service . $order->virtual_service_id }}&service&id={{ $order->id }}"
                                   class="text-blue-800 text-center block"
                                   target="_blank">
                                    {{ $order->service . $order->virtual_service_id }}
                                </a>
                            @else
                                <a href="https://crm.marudi.store/fabcrm/page/order_info?id={{ $order->id }}"
                                   class="text-blue-800 text-center block"
                                   target="_blank">
                                    {{ $order->id }}
                                </a>
                            @endif
                        </td>

                        <td class="text-center py-2">
                            @if (!empty($order->add_ts))
                                {{ \Carbon\Carbon::parse($order->add_ts)->format('d.m.y') }}
                            @else
                                -
                            @endif
                        </td>

                        <td class="py-2">
                            <b>{{ $order->client->name_i }} {{ $order->client->name_f }} {{ $order->client->name_o }}</b>
                            <br/>
                            {{ $order->name }}
                        </td>

                        <td class="text-end py-2">{{ $order->price ? number_format($order->price, 0, '.', '`') : '-' }}</td>

                        <td class="text-end py-2 {{ $order->viruchka > 0 ? 'text-green-800' : 'text-red-800' }}">
                            {{ number_format($order->viruchka, 0, '.', '`') }}
                        </td>

                        <td class="text-end py-2">-<br/>-</td>

                        <td class="text-end py-2">-<br/>{{ $order->summa_work ? number_format($order->summa_work, 0, '.', '`') : '-' }}</td>

                        <td class="text-end py-2">
                            {{ $order->summa_install ? number_format($order->summa_install, 0, '.', '`') : '-' }}
                            <br/>
                            {{ $order->summa_build ? number_format($order->summa_build, 0, '.', '`') : '-' }}
                        </td>

                        <td class="text-end py-2">{{ $order->summa_zamer ? number_format($order->summa_zamer, 0, '.', '`') : '-' }}</td>

                        <td class="text-end py-2">
                            {{ $order->summa_dost ? number_format($order->summa_dost, 0, '.', '`') : '-' }}
                            <br/>
                            {{ $order->summa_gruz ? number_format($order->summa_gruz, 0, '.', '`') : '-' }}
                        </td>

                        <td class="text-end py-2">-<br/>-</td>

                        <td class="text-end py-2">{{ $order->summa_dop ? number_format($order->summa_dop, 0, '.', '`') : '-' }}</td>

                        <td class="text-end py-2 pr-1">
                            {{ $order->design ? number_format($order->design, 0, '.', '`') : '-' }}
                            <br/>-
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="container mx-auto mt-4">
{{--        {{ $items->onEachSide(2)->links('livewire.cms2.buh-pagination') }}--}}
        {{ $items->onEachSide(2)->links('pagination::tailwind') }}

    </div>
</div>
