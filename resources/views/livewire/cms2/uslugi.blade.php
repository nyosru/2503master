<div class="container mx-auto">
    {{-- Breadcrumb and header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'uslugi.index','name'=>'Услуги']]"/>
                </div>
            </div>
        </div>
    </div>

    {{--    <pre style="font-size:10px;">{{ print_r($items->toArray()) }}</pre>--}}

    <div>
        <h2>Список заказов</h2>

        <div class="grid grid-cols-12 text-sm bg-gray-300 p-2 font-bold">

            <div class="text-center">ID</div>

            <div  class="text-center col-span-2">Название
            <br/>Клиент</div>
            <div class="text-center">Договор</div>
            <div class="text-center">Статус</div>
            <div class="text-center">прочее</div>

            <div class="text-center">Контракт</div>
            <div class="text-center">Комментарий</div>

            <div class="text-center">Действия</div>
            <div class="text-center"></div>

        </div>

        @foreach($items as $order)
            <div class="grid grid-cols-12 text-sm border-b border-gray-200 bg-white p-2">

                <div>
                    {{ $order->id }}
                </div>

                <div class="col-span-2">
                    <img src="/icon/{{ $order->client->physical_person ? 'bman.png' : 'briefcase.svg' }}"
                         class="w-[18px] mr-1 inline"/>
                    {{ $order->client->name_f }} {{ $order->client->name_i ? mb_substr($order->client->name_i,0,1).'.' : '' }}{{ $order->client->name_o ? mb_substr($order->client->name_o,0,1).'.' : '' }}
                    <br/>
                    {{ $order->name }}
                </div>
                <div>
                </div>
                <div class="text-center">
                    {{ $order->manager->name }}
                    <div class="text-xs" >
                    {{ $order->manager->department }}
                    </div>
                </div>

                <div>{{ $order->contract ? $order->contract->uid : 'Нет' }}</div>
                <div>
                </div>
                <div>{{ $order->comment }}</div>

                <div class="col-span-2">
                    <div style="max-height: 300px; overflow: auto; ">
                    form_name:{{ $order->form->name }}
                    <br/>
                    contract->order_id: {{ $order->contract->order_id }}
                    <br/>
                    manager->name: {{ $order->manager->name }}
                    <br/>
                    manager->department: {{ $order->manager->department }}
                    <br/>
                    {{-- Кнопка редактирования или другие действия --}}
                    {{--                    <button wire:click="edit({{ $order->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">Редактировать</button>--}}
                        orders_logs
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->orders_logs->toArray(), true) }}
                    </pre>
                    manager
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->manager->toArray(), true) }}
                    </pre>
                    last_roles_log<br/>
                        @if( !empty($order->last_roles_log) )
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->last_roles_log->toArray(), true) }}
                    </pre>
                        @endif
                    contract
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->contract->toArray(), true) }}
                    </pre>
                    client
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->client->toArray(), true) }}
                    </pre>
                    form
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->form->toArray(), true) }}
                    </pre>
                    all
                    <pre style="font-size:8px; max-height: 100px; overflow: auto;">
                        {{ print_r($order->toArray(), true) }}
                    </pre>
                </div>
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
