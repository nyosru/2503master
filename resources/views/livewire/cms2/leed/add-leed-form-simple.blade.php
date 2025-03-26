<div class="xinline flex flex-col xw-[90%] px-2 xfloat-right"
    {{--     style="z-index: 50;"--}}
>
    <div class="text-center">
        <!-- Кнопка для открытия модального окна -->
        <button wire:click="toggleForm" class="xw-full xbg-blue-400 py-0 px-4 rounded-xl" title="Добавить Лид">
            {{--            + Лид--}}
            <svg class="h-8 w-8 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                <path d="M16 11h6m-3 -3v6"/>
            </svg>
        </button>
    </div>

    <!-- Сообщение об успешном добавлении -->
    {{-- @if (session()->has('message')) --}}
    {{--     <div class="bg-yellow-200 rounded ml-5 px-5 py-2 text-green-500">{{ session('message') }}</div> --}}
    {{-- @endif --}}

    <!-- Модальное окно -->
    @if ($isFormVisible)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        style="z-index: 100"
        >

            <form wire:submit.prevent="addLeedRecord">
                <div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-lg xp-3 w-[400px]">
                    <div class="bg-gray-200 mb-2 shadow">
                        <a href="#" title="закрыть" wire:click.prevent="$set('isFormVisible', false)"
                           class="py-2 pr-4 float-right">x
                        </a>
                        <h2 class="text-lg font-semibold px-3 py-1">Новый Лид</h2>
                    </div>

                    <div class="w-full px-3 ">
                        <label for="name" class="block text-gray-700 text-sm">
                            Название
                        </label>
                        <input type="text" wire:model="name" id="name"
                               class="block mb-2 p-2 border rounded w-full">

                        <label for="fio" class="block text-gray-700 text-sm">
                            ФИО
                        </label>
                        <input type="text" wire:model="fio" id="fio"
                               class="block mb-2 p-2 border rounded w-full">

                        <label for="phone" class="block text-gray-700 text-sm">
                            Телефон
                        </label>
                        <input type="text" wire:model="phone" id="phone"
                               class="block mb-2 p-2 border rounded w-full">
                        {{--                    <input type="text" wire:model="telegram" placeholder="Телеграм" class="block mb-2 p-2 border rounded w-full">--}}
                        {{--                    <input type="text" wire:model="whatsapp" placeholder="WhatsApp" class="block mb-2 p-2 border rounded w-full">--}}


                        <label class="block text-gray-700 text-sm">
                            Изделие:


                            <select wire:model="order_product_types_id" class="block mb-2 p-2 border rounded w-full">
                                <option value="" selected>---</option>
                                @foreach ($types as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </label>

                        {{--                        <label class="block text-gray-700 text-sm">--}}
                        {{--                            Компания--}}
                        {{--                            <input type="text" wire:model="company" id="company" placeholder="Компания"--}}
                        {{--                                   class="block mb-2 p-2 border rounded w-full">--}}
                        {{--                        </label>--}}

                        <label class="block text-gray-700 text-sm">
                            Бюджет
                            <input type="number" wire:model="budget" id="budget" placeholder=""
                                   class="block mb-2 p-2 border rounded w-full">
                        </label>

                        <!-- Выпадающий список для выбора поставщика -->

                        <label for="comment" class="block text-gray-700 text-sm">
                            Источник:
                            <select wire:model="client_supplier_id" class="block mb-2 p-2 border rounded w-full">
                                <option value="" selected>-- нет --</option>
                                @foreach ($suppliers as $supplier)
                                    <option
                                        value="{{ $supplier->id }}">{{ $supplier->title }} {{ $supplier->name ?? '' }} {{ $supplier->phone ?? '' }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label for="comment" class="block text-gray-700 text-sm">
                            Комментарий
                        </label>

                        <textarea wire:model="comment" id="comment"
                                  class="block mb-2 p-2 border rounded w-full"></textarea>


                    </div>
                    @if(1==2)
                        <div class="w-1/3">

                            <div class="bg-cyan-100 px-2 py-1 " style="max-height: 50vh; overflow: auto;">

                                <label for="client_id" class="block text-gray-700 bg-cyan-300 shadow-md px-3 my-3">
                                    <b>Клиент</b> <span class="text-sm">Создать / Выбрать -> ФИО (юр.лицо)</span>
                                </label>

                                <select wire:model.live="client_id" id="client_id"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{--                            <option value="yes">Физическое лицо</option>--}}
                                    {{--                            <option value="no">Юридическое лицо</option>--}}
                                    <option value="">Выберите клиента</option>
                                    <option value="add">+ Создать клиента</option>
                                    <option value="" disabled>--- текущие клиенты ---</option>
                                    @foreach( $clients as $i )
                                        <option value="{{ $i->id }}">
                                            @if(empty($i->name_f))
                                                {{ $i->name_f ?? '-'}} {{ $i->name_i ?? '-' }} {{ $i->name_o ?? '-' }}
                                            @else
                                                {{ $i->name_f }} {{ !empty($i->name_i) ? mb_substr($i->name_i,0,1).'.':'' }}{{ !empty($i->name_o) ? mb_substr($i->name_o,0,1).'.' : '' }}
                                            @endif
                                            @if( !empty($i->ur_name) || !empty($i->name_company) )
                                                (
                                                @if( empty($i->name_company) && !empty($i->ur_name) )
                                                    {{$i->ur_name}}
                                                @elseif( !empty($i->name_company) && empty($i->ur_name) )
                                                    {{$i->name_company}}
                                                @elseif( strlen($i->name_company) != 0 && strlen($i->ur_name) > strlen($i->name_company) )
                                                    {{$i->name_company}}
                                                @else
                                                    {{$i->ur_name}}
                                                @endif
                                                )
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                {{--                        client_id: {{ $client_id }}--}}

                                @if( !empty($client_id) )
                                    @if( $client_id == 'add' )
                                        <div class="bg-cyan-300 px-3 shadow-md my-3">
                                            Создать клиента
                                        </div>
                                        {{--                                        добавить клиента--}}

                                        <livewire:cms2.order.add-form-simple


                                            {{--                                            :client_id="$client_id"--}}
                                            {{--                                            :key="$client_id"--}}
                                        />
                                    @else
                                        {{--                                        <div class="px-2">--}}
                                        <livewire:cms2.informer.for-add-leed-client-info-mini
                                            :client_id="$client_id"
                                            :key="$client_id"/>
                                    @endif
                                @endif
                            </div>

                        </div>
                        <div class="xxw-screen-[20%] w-1/3">

                            <div class="bg-yellow-200 px-2 py-1">
                                <div class="bg-yellow-300 shadow-md px-3 my-3">
                                    Заказ
                                </div>
                                <div style="max-height: 40vh; overflow: auto;">
                                    {{--                                    order                                    <br/>--}}
                                    {{--                                    <pre>{{ print_r($order) }}</pre>--}}
                                    <livewire:cms2.order.add-form-simple
                                        typeDispatch="creat_leed_mini"
                                    />
                                </div>
                            </div>

                        </div>
                    @endif

                    {{--                    </div>--}}

                    <div class="flex justify-center py-3 bg-gray-100">
                        {{--                        <button type="button" wire:click="$set('isFormVisible', false)"--}}
                        {{--                                class="bg-red-500 text-white px-4 py-2 rounded mr-2">Закрыть--}}
                        {{--                        </button>--}}
                        <button type="submit" class="bg-blue-400 py-2 px-4 rounded-xl">Добавить</button>
                    </div>


                </div>
            </form>
        </div>
</div>
@endif
</div>
