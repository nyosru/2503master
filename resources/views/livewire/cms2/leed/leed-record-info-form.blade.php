<div>

    <div class="p-2 text-lg border-b">
        <span class="font-bold">Лид</span>
    </div>

{{--        <pre class="text-xs">{{ print_r($leed->toArray()) }}</pre>--}}

    <form wire:submit="saveChanges">

        <div class="px-2">
            <div class="flex flex-col pt-2">

{{--                <pre class="text-xs">{{ print_r($leed->column->board->fieldSettings->toArray()) }}</pre>--}}


<pre>{{ print_r($leed->column->board->fieldSettings->toArray()) }}</pre>

{{--                @foreach(['name', 'fio', 'phone','order_product_types_id','budget', 'client_supplier_id',--}}
{{--                    //'company',--}}
{{--                    'comment'] as $key)--}}
                @foreach( $leed->column->board->fieldSettings as $key)
{{--                    @if(!$key->is_enabled)--}}
{{--                        @continue--}}
{{--                        @endif--}}
                    {{--                    @if($leed->{$key} !== null)--}}
                    <div class="py-1">
                        <label for="{{ $key->field_name }}" class="block text-sm font-medium text-gray-700">
                            @if($key->field_name === 'name')
                                Название
{{--                                <sup>(техническое для себя)</sup>--}}
                            @elseif($key->field_name === 'comment')
                                Комментарий
                            @elseif($key->field_name === 'company')
                                Компания

                            @elseif($key->field_name === 'price')
                                Цена
                            @elseif($key->field_name === 'platform')
                                Платформа
                            @elseif($key->field_name === 'submit_before')
                                Оплата после доставки (дней)
                            @elseif($key->field_name === 'base_number')
                                Номер
                            @elseif($key->field_name === 'budget')
                                Бюджет
                            @elseif($key->field_name === 'fio')
                                ФИО
                            @elseif($key->field_name === 'phone')
                                Тел
                            @elseif($key->field_name === 'client_supplier_id')
                                Источник лида
                            @elseif($key->field_name === 'client_supplier_id')
                                Источник лида
                            @elseif($key->field_name === 'order_product_types_id')
                                Тип изделия
                            @else
                                {{ ucfirst($key->field_name) }}
                            @endif
                        </label>

                        @if($isEditing)
                            @if($key->field_name === 'comment')
                                <textarea wire:model="{{ $key }}" id="{{ $key }}"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                          rows="3"></textarea>
                            @elseif($key->field_name === 'client_supplier_id')
                                <select class="rounded w-full" wire:model="{{ $key }}">
                                    <option value="">--</option>
                                    @foreach( $suppliers as $s )
                                        <option value="{{ $s->id }}">{{ $s->title }}</option>
                                    @endforeach
                                </select>
                            @elseif($key->field_name === 'order_product_types_id')
                                <select class="rounded w-full" wire:model="{{ $key }}">
                                    <option value="">--</option>
                                    @foreach( $types as $s )
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" wire:model="{{ $key->field_name }}" id="{{ $key->field_name }}"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
                            @endif
                        @else
                            <p class="mt-1">{{ $leed->{$key->field_name} }}</p>
                        @endif
                        @error($key->field_name)
                        <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--                    @endif--}}
                @endforeach
            </div>

            @if(1==2)

                @if(!empty($leed->client))
                    <div class="py-1">
                        <label class="block text-sm font-medium text-gray-700">Клиент</label>
                        <a href="{{ route('clients.info', ['client_id' => $leed->client->id]) }}" wire:navigate
                           class="text-indigo-600 hover:text-indigo-900">
                            {{ $leed->client->name_f ?? '' }} {{ $leed->client->name_i ?? '' }} {{ $leed->client->name_o ?? '' }}
                            /
                            @if(!empty($leed->client->ur_name))
                                {{ $leed->client->ur_name }}
                            @elseif(!empty($leed->client->name_company))
                                {{ $leed->client->name_company }}
                            @endif
                        </a>
                    </div>
                @endif

                @if(!empty($leed->supplier))
                    <div class="py-1">
                        <label class="block text-sm font-medium text-gray-700">Источник</label>
                        <div>
                            {{ $leed->supplier->title }}
                            @if(!empty($leed->supplier->name))
                                <br>{{ $leed->supplier->name }}
                            @endif
                        </div>
                    </div>
                @endif

            @endif

        </div>

        <div class="text-right py-3 bg-gray-200 px-2">

            @if (session()->has('messageItemInfo'))
{{--                <span class="bg-green-100 text-green-800 p-2 rounded mb-4">--}}
{{--                        {{ session('messageItemInfo') }}--}}
                <small title="{{ session('messageItemInfo') }}" class="bg-green-300 p-1">
                    {{ session('messageItemInfo') }}
{{--                <svg--}}

{{--                        class="inline h-6 w-6 text-blue-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="9 11 12 14 20 6" />  <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>--}}
                </small>
{{--                    </span>--}}
            @endif

            <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded">Сохранить</button>
        </div>

    </form>
</div>
