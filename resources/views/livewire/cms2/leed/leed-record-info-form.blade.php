<div>

    <div class="p-2 text-lg border-b">
        <span class="font-bold">Лид</span>

        @if (session()->has('messageItemInfo'))
            <span
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                title="{{ session('messageItemInfo') }}" class="bg-green-300 p-1">
                {{ session('messageItemInfo') }}
            </span>
        @endif

    </div>

    {{--        <pre class="text-xs">{{ print_r($leed->toArray()) }}</pre>--}}

    <form wire:submit="saveChanges">

        <div class="px-2">
            <div class="flex flex-col pt-2 max-h-[550px] overflow-x-auto">

                {{--                <pre class="text-xs">{{ print_r($leed->column->board->fieldSettings->toArray()) }}</pre>--}}


                {{--<pre>{{ print_r($leed->column->board->fieldSettings->toArray()) }}</pre>--}}

                {{--                @foreach(['name', 'fio', 'phone','order_product_types_id','budget', 'client_supplier_id',--}}
                {{--                    //'company',--}}
                {{--                    'comment'] as $key)--}}
                @foreach( $leed->column->board->fieldSettings as $key)
                    {{--                    @if(!$key->is_enabled)--}}
                    {{--                        @continue--}}
                    {{--                        @endif--}}
                    {{--                    @if($leed->{$key} !== null)--}}
                    <div class="py-1">
                        {{--                        <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($key->toArray()) }}</pre>--}}
                        {{--                        <pre>{{ print_r($leed->{$key}) }}</pre>--}}
                        {{--                        {{ $key->field_name }}--}}
                        <label for="{{ $key->field_name }}"
                               {{--                               title="{{ $key->field_name }}"--}}
                               title="{{ $key->orderRequest->rename->description ?? $key->orderRequest->description }}"
                               class="block text-sm font-medium text-gray-700">

                            @if( !empty($key->orderRequest->rename->name) )
                                {{ $key->orderRequest->rename->name }}
                            @elseif( !empty($key->orderRequest->name) )
                                {{ $key->orderRequest->name }}
                            @else
                                {{ $key->field_name }}
                            @endif

                        </label>

                        @if($isEditing)


                            <div
                                x-data="{ link: '{{$link}}' }"
                                class="relative max-w-md"
                            >

                                @if($key->field_name === 'comment')
                                    <textarea wire:model="{{ $key->field_name }}" id="{{ $key }}"
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                              rows="3"></textarea>
                                @elseif($key->field_name === 'client_supplier_id')
                                    <select class="rounded w-full" wire:model="{{ $key->field_name }}">
                                        <option value="">--</option>
                                        @foreach( $suppliers as $s )
                                            <option value="{{ $s->id }}">{{ $s->title }}</option>
                                        @endforeach
                                    </select>
                                @elseif($key->field_name === 'order_product_types_id')
                                    <select class="rounded w-full" wire:model="{{ $key->field_name }}">
                                        <option value="">--</option>
                                        @foreach( $types as $s )
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                @else

                                    {{--                                    @if( $key->orderRequest->is_web_link )--}}
                                    {{--                                        777--}}
                                    {{--                                        {{ $link ?? '' }}--}}
                                    {{--                                        @endif--}}
                                    {{--                                        {{ $key->field_name }}--}}
                                    <input

                                        wire:model="{{ $key->field_name }}"
                                        id="{{ $key->field_name }}"

                                        @if( $key->orderRequest->number )
                                            type="number"
                                        @elseif( $key->orderRequest->date )
                                            type="date"
                                        @elseif( $key->orderRequest->is_web_link )
                                            type="text"
                                            x-model="link"
                                        @else
                                            type="text"
                                        @endif

                                        class="shadow-sm mt-1 block w-full
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                        border-gray-300 rounded-md
                                        @if( $key->orderRequest->is_web_link ) pr-20 @endif
                                        "

                                    >
                                    @if( $key->orderRequest->is_web_link )
                                        <button
                                            type="button"
                                            title="открыть ссылку в новом окне"
                                            class="absolute right-1 top-1/2 -translate-y-1/2
                                                bg-blue-200
                                                text-white px-2 py-1 rounded
                                                hover:bg-blue-700 transition"
                                            @click="window.open(link, '_blank')"
                                        >↗
                                        </button>
                                    @endif
                                @endif
                                {{--                            @endif--}}
                            </div>
                        @else
                            <p class="mt-1">{{ $leed->{$key->field_name} }}</p>
                        @endif

                        @error($key->field_name)
                        <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>

                @endforeach
            </div>

        </div>

        <div class="text-right py-3 bg-gray-200 px-2">

            @if (session()->has('messageItemInfo'))
                <small
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    title="{{ session('messageItemInfo') }}" class="bg-green-300 p-1">
                    {{ session('messageItemInfo') }}
                </small>
            @endif

            <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded">Сохранить</button>
        </div>

    </form>
</div>
