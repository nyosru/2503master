<div class="container mx-auto relative">

    {{-- Breadcrumb and header --}}
    <div class="app-content-header">
        <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'order.index','name'=>'Заказы']]"/>
    </div>

    {{--    <pre style="font-size:10px;">{{ print_r($items->toArray()) }}</pre>--}}

    <div class="">


        <div class="w-full text-right p-2 mb-2 block">

            @if( empty($return_url ) )
                <a href="{{ route('order.create') }}" wire:navigate
                   class="bg-orange-300 rounded hover:shadow px-2 py-1">Создать</a>
            @endif

            <form class="ml-[10px] inline-block float-left" wire:submit.prevent="goSearch">

                @if( !empty($search) )
                    <span class="bg-yellow-400 px-2 py-2">
                    Поиск: {{ $search }}
                        </span>
                @endif

                <input type="text"
                       wire:model="search"
                       placeholder="Поиск"
                       class="shadow appearance-none border rounded w-[150px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-0"/>
                <button type="submit" class="bg-gray-400 px-2 py-1 ml-[-3px]">Искать</button>
            </form>
        </div>

        <div class="grid grid-cols-12 text-sm bg-gray-300 font-bold" style="position: sticky; top: 0;">

            {{--            <div class="text-center">ID</div>--}}
            {{--            <div class="text-center">№</div>--}}
            <div class="py-2 text-center border-r-[3px]">Договор</div>

            <div class="py-2 text-center col-span-2 border-r-[3px]">Клиент
                <br/>
                Заказ
            </div>
            <div class="py-2 border-r-[3px] text-center">Тип</div>
            <div class="py-2 border-r-[3px] text-center">Цена</div>
            <div class="py-2 border-r-[3px] text-center">У кого заказ</div>
            <div class="py-2 border-r-[3px] text-center">Метки</div>

{{--            <div class="py-2 border-r-[3px] text-center">2</div>--}}
            <div class="py-2 border-r-[3px] text-center">3</div>

            <div class="py-2 text-center col-span-4">доп</div>
            {{--            <div class="text-center"></div>--}}

        </div>

        @foreach($items as $k=>$order)
            <div class="grid grid-cols-12 text-sm border-b border-gray-200 p-2
            {{($k%2) ? 'bg-gray-100' : 'bg-white' }}
            ">

                {{--                id--}}
                {{--                <div>                    {{ $order->id }}                </div>--}}
                <div>


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
                            {{--                            {{ $order->id }}--}}
                            {{ date('y',strtotime($order->add_ts)) }}-{{ $order->virtual_order_id }}
                        </a>
                    @endif

                    <a href="{{ route('order.item',['order_id' => $order->id]) }}"
                       wire:navigate
                       class="bg-orange-300 p-1 rounded">
                        посмотреть
                    </a>

                </div>

                <div class="col-span-2">
                    <img src="/icon/{{ $order->client->physical_person ? 'bman.png' : 'briefcase.svg' }}"
                         class="w-[18px] mr-1 inline"/>
                    {{ $order->client->name_f }} {{ $order->client->name_i ? mb_substr($order->client->name_i,0,1).'.' : '' }}{{ $order->client->name_o ? mb_substr($order->client->name_o,0,1).'.' : '' }}
                    <br/>
                    <b>{{ $order->name }}</b>
                </div>
                <div class="text-center">
                    {{--                    {{$order->types}}--}}
                    {{$order->type_name}}
                </div>
                <div class="text-center">
                    {{--                    {{$order->types}}--}}
                    {{$order->price ?? '-'}}
                </div>
                <div class="text-center">
                    {{ $order->manager->name ?? '- $order->manager->name' }}
                    <div class="text-xs">
                        {{ $order->manager->department ?? '- $order->manager->department' }}
                    </div>
                </div>

                {{--                Метки--}}
                <div></div>

                {{--                2--}}
{{--                <div></div>--}}

                {{--                3--}}
                <div>{{ $order->comment }}</div>

                <div class="col-span-4">
                    @permission('разработка')

                    <button wire:click="changeShowInfo({{$order->id}})" class="p-2 bg-blue-200 rounded">показать тех
                        инфу
                    </button>
                    @if( isset($show_info[$order->id]) && $show_info[$order->id] )
                        <div style="xmax-height: 300px; xoverflow: auto; ">
{{--                            form_name:{{ $order->form->name ?? '- $order->form->name' }}--}}
{{--                            <br/>--}}
{{--                            contract->order_id: {{ $order->contract->order_id }}--}}
{{--                            <br/>--}}
{{--                            manager->name: {{ $order->manager->name ?? '- $order->manager->name' }}--}}
{{--                            <br/>--}}
{{--                            manager->department: {{ $order->manager->department ?? '- $order->manager->department' }}--}}
{{--                            <br/>--}}
{{--                            --}}{{-- Кнопка редактирования или другие действия --}}
{{--                            --}}{{--                    <button wire:click="edit({{ $order->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">Редактировать</button>--}}
{{--                            orders_logs--}}
{{--                            @if( !empty($order->orders_logs) )--}}
{{--                                <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--                                {{ print_r($order->orders_logs->toArray(), true) }}--}}
{{--                                </pre>--}}
{{--                            @endif--}}
{{--                            <br/>--}}
{{--                            manager--}}
{{--                            <div>--}}
{{--                                @if( !empty($order->manager))--}}

{{--                                    <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--{{ print_r($order->manager->toArray(), true) }}--}}
{{--</pre>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            payments--}}
{{--                            <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--                                    {{ print_r($order->payments->toArray(), true) }}--}}
{{--                                    </pre>--}}

{{--                            last_roles_log<br/>--}}
{{--                            @if( !empty($order->last_roles_log) )--}}
{{--                                <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--{{ print_r($order->last_roles_log->toArray(), true) }}--}}
{{--</pre>--}}
{{--                            @endif--}}
{{--                            contract--}}
{{--                            <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--{{ print_r($order->contract->toArray(), true) }}--}}
{{--</pre>--}}
{{--                            client--}}
{{--                            <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--{{ print_r($order->client->toArray(), true) }}--}}
{{--</pre>--}}
{{--                            form--}}
{{--                            @if(!empty($order->form))--}}
{{--                            <div>--}}
{{--                            <pre class="border p-2" style="font-size:8px; max-height: 100px; overflow: auto;">--}}
{{--{{ print_r($order->form->toArray(), true) }}--}}
{{--</pre>--}}
{{--                            </div>--}}
{{--                            @endif--}}
                            all
                            <pre class="border p-2" style="font-size:8px; max-height: 600px; overflow: auto;">
{{ print_r($order->toArray(), true) }}
</pre>
                        </div>
                    @endif
                    @endpermission
                </div>
            </div>
        @endforeach

        <!-- Пагинация -->
        <div class="mt-4">
            {{--            {{ $items->links() }} <!-- Отображение ссылок для навигации -->--}}
            {{ $items->onEachSide(2)->links('pagination::tailwind') }}
        </div>

        <!-- Выбор количества элементов на странице -->
        @if(1==1)
            <div class="mt-4">
                <label for="itemsPerPage">Показать:</label>
                <select wire:model.live="itemsPerPage" id="itemsPerPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            // Вы можете добавить дополнительные скрипты здесь, если необходимо
        </script>
    @endpush


</div>
