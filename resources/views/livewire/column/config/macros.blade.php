<div>
    <h3 class="p-1 bg-red-100 mb-1 ">Настройки макросов:</h3>

    <div class="flex flex-col space-y-2">

        <div class="">
            {{--                                    <pre--}}
            {{--                                        class="max-h-[500px] text-xs--}}
            {{--                                        overflow-auto--}}
            {{--                                        ">--}}
            {{--                                        {{ print_r($macroses->toArray()) }}--}}
            {{--                                        {{ print_r($macroses) }}--}}
            {{--                                    </pre>--}}
            {{--                                    <pre class="max-h-[200px] text-xs overflow-auto">{{ print_r($macroses) }}</pre>--}}
            @foreach( $macroses as $mm )
                {{--                                        <pre--}}
                {{--                                            class="--}}
                {{--                                            max-h-[200px] --}}
                {{--                                            text-xs--}}
                {{--                                            overflow-auto--}}
                {{--                                            ">{{ print_r($mm) }}</pre>--}}
                <livewire:column.config-macro-item-show :item="$mm"/>
            @endforeach
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg w-full">
            <livewire:column.config-macro-form
                :column="$column->id"
                type="on_pause_to_move"
                board_id="{{ $column->board_id }}"/>
        </div>


        {{--                                <div class="flex flex-row font-bold bg-black/20">--}}
        {{--                                    <div class="w-[30px] text-center">--}}
        {{--                                        вкл--}}
        {{--                                    </div>--}}
        {{--                                    <div class="flex-1">--}}
        {{--                                        описание, настройки--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}

        <div class="border-l-[10px] border-l-yellow-200">
            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                <label>
                    <input type="checkbox"
                           class="p-1 rounded"
                        {{--                                           wire:model="settings.{{ $key }}"--}}
                        {{--                                           @if($value) checked @endif --}}
                    />
                    перенос записей если висит без новых комментариев и движений
                </label>
            </div>
            <div class="pl-2
{{--                                    text-center--}}
">
                запись находится в столбце дольше
                <div class="">
                    <input
                        class="p-1 rounded w-[60px] bg-transparent"
                        type="number"
                        min="1"
                        max="99"
                        step="1"
                    />

                    <span class="text-sm">дней (включительно)</span>
                </div>

                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                    <option>-- выберите столбец --</option>
                </select>.
            </div>
        </div>


        <div class="border-l-[10px] border-l-yellow-200">
            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                <label>
                    <input type="checkbox"
                           class="p-1 rounded"
                        {{--                                           wire:model="settings.{{ $key }}"--}}
                        {{--                                           @if($value) checked @endif --}}
                    />
                    перенос записей если висит без новых комментариев и движений
                </label>
            </div>
            <div class="pl-2
{{--                                    text-center--}}
">
                запись находится в столбце дольше
                <div class="">
                    <input
                        class="p-1 rounded w-[60px] bg-transparent"
                        type="number"
                        min="1"
                        max="99"
                        step="1"
                    />

                    <span class="text-sm">дней (включительно)</span>
                </div>

                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                    <option>-- выберите столбец --</option>
                </select>.
            </div>
        </div>


        <div class="border-l-[10px] border-l-yellow-200">
            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                <label>
                    <input type="checkbox"
                           class="p-1 rounded"
                        {{--                                           wire:model="settings.{{ $key }}"--}}
                        {{--                                           @if($value) checked @endif --}}
                    />
                    перенос записей если висит без новых комментариев и движений
                </label>
            </div>
            <div class="pl-2
{{--                                    text-center--}}
">
                запись находится в столбце дольше
                <div class="">
                    <input
                        class="p-1 rounded w-[60px] bg-transparent"
                        type="number"
                        min="1"
                        max="99"
                        step="1"
                    />

                    <span class="text-sm">дней (включительно)</span>
                </div>

                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                    <option>-- выберите столбец --</option>
                </select>.
            </div>
        </div>


        <div class="border-l-[10px] border-l-yellow-200">
            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                <label>
                    <input type="checkbox"
                           class="p-1 rounded"
                        {{--                                           wire:model="settings.{{ $key }}"--}}
                        {{--                                           @if($value) checked @endif --}}
                    />
                    перенос записей если висит без новых комментариев и движений
                </label>
            </div>
            <div class="pl-2
{{--                                    text-center--}}
">
                запись находится в столбце дольше
                <div class="">
                    <input
                        class="p-1 rounded w-[60px] bg-transparent"
                        type="number"
                        min="1"
                        max="99"
                        step="1"
                    />

                    <span class="text-sm">дней (включительно)</span>
                </div>

                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                    <option>-- выберите столбец --</option>
                </select>.
            </div>
        </div>


    </div>


</div>
