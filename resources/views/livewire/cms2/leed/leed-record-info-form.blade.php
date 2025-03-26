<div>

    <div class="p-2 text-lg border-b">
        <span class="font-bold">Лид</span>
    </div>

    {{--    <pre>{{ print_r($leed) }}</pre>--}}

    <form wire:submit="saveChanges">

        <div class="px-2">
            <div class="flex flex-col pt-2">
                @foreach(['name', 'fio', 'phone','order_product_types_id','budget', 'client_supplier_id',
                    //'company',
                    'comment'] as $key)
                    {{--                    @if($leed->{$key} !== null)--}}
                    <div class="py-1">
                        <label for="{{ $key }}" class="block text-sm font-medium text-gray-700">
                            @if($key === 'name')
                                Название
{{--                                <sup>(техническое для себя)</sup>--}}
                            @elseif($key === 'comment')
                                Комментарий
                            @elseif($key === 'company')
                                Компания
                            @elseif($key === 'budget')
                                Бюджет
                            @elseif($key === 'fio')
                                ФИО
                            @elseif($key === 'phone')
                                Тел
                            @elseif($key === 'client_supplier_id')
                                Источник лида
                            @elseif($key === 'client_supplier_id')
                                Источник лида
                            @elseif($key === 'order_product_types_id')
                                Тип изделия
                            @else
                                {{ ucfirst($key) }}
                            @endif
                        </label>

                        @if($isEditing)
                            @if($key === 'comment')
                                <textarea wire:model="{{ $key }}" id="{{ $key }}"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                          rows="3"></textarea>
                            @elseif($key === 'client_supplier_id')
                                <select class="rounded w-full" wire:model="{{ $key }}">
                                    <option value="">--</option>
                                    @foreach( $suppliers as $s )
                                        <option value="{{ $s->id }}">{{ $s->title }}</option>
                                    @endforeach
                                </select>
                            @elseif($key === 'order_product_types_id')
                                <select class="rounded w-full" wire:model="{{ $key }}">
                                    <option value="">--</option>
                                    @foreach( $types as $s )
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" wire:model="{{ $key }}" id="{{ $key }}"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
                            @endif
                        @else
                            <p class="mt-1">{{ $leed->{$key} }}</p>
                        @endif
                        @error($key)
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
                <abbr title="{{ session('messageItemInfo') }}" >
                <svg

                        class="inline h-6 w-6 text-blue-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="9 11 12 14 20 6" />  <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                </abbr>
{{--                    </span>--}}
            @endif

            <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded">Сохранить</button>
        </div>

    </form>
</div>
