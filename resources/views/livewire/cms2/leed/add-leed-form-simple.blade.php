<div class="xinline flex flex-col xw-[90%] px-2 xfloat-right">

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

                    <div class="w-full px-3 max-h-[70vh] overflow-auto" id="add-leed-form-simple">

{{--                        <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($allowedFields->toArray()) }}</pre>--}}

                        @foreach($allowedFields as $field)

                            {{--                            <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($field->toArray()) }}</pre>--}}

                            <label for="{{ $field['field_name'] }}" class="block text-gray-700 text-sm">
                                <abbr
                                    title="{{ $field->orderRequest->rename->description ?? $field->orderRequest->description}}">

                                    {{--                                    ++--}}
                                    {{--                                    {{$field->orderRequest->name}}--}}
                                    {{--                                    <br/>--}}

                                    @if( !empty($field->orderRequest->rename->name) )
                                        {{ $field->orderRequest->rename->name }}
                                    @elseif( !empty($field->orderRequest->name) )
                                        {{ $field->orderRequest->name }}
                                    @else
                                        {{ $field->field_name }}
                                    @endif

                                </abbr>
                            </label>

                            <input
                                @if(
                                    $field->orderRequest->number
                                    || $field['field_name'] == 'base_number'
                                    ||  $field['field_name'] == 'budget'
                                    ||  $field['field_name'] == 'price')
                                    type="number"
                                @elseif(
                                    $field->orderRequest->number
                                    || $field['field_name'] == 'pay_day_every_month'
                                    )
                                    type="number" min="1" max="31"
                                @elseif(
                                $field->orderRequest->datetime
                                    )
                                    type="datetime-local"
                                @elseif(
                                $field->orderRequest->date
                                || $field['field_name'] == 'submit_before'
                                || $field['field_name'] == 'payment_due_date'
                                || $field['field_name'] =='date_start'
                                || $field['field_name'] =='pay_day_every_year' )
                                    type="date"
                                @else
                                    type="text"
                                @endif

                                wire:model="{{ $field['field_name'] }}" id="{{ $field['field_name'] }}"
                                class="block mb-2 p-2 border rounded w-full">

                            @error($field['field_name'])
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                        @endforeach

                    </div>

                    <div class="flex justify-center py-3 bg-gray-100">
                        <button type="submit" class="bg-blue-400 py-2 px-4 rounded-xl">Добавить</button>
                    </div>

                </div>
            </form>

        </div>
    @endif
</div>
