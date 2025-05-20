<div>

    {{--    <div class="text-sm text-green-500" wire:loading.delay>--}}
    {{--        Сохранение...--}}
    {{--    </div>--}}

    {{--    <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($settings,1) }}</pre>--}}

    <div class="space-y-4">
        <style>
            .table-polya td,
            .table-polya th {
                padding: 0.5rem;
            }

            .table-polya tbody tr:nth-child(2\n) td {
                background-color: #eee;
            }

            .table-polya tbody tr:nth-child(2\n-1) td {
                background-color: #fff;
            }
        </style>
        <table class="  table-polya">
            <thead>
            <tr>
                <th>Поле</th>
                <th>Новое название</th>
                <th>Тип</th>
                <th>Включено</th>
                <th>Показывать<br/>на старт доске</th>
                <th>Использовать<Br/>в&nbsp;смс в&nbsp;телеге</th>
                <th>Сортировка</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $field )
                {{--            <livewire:field-settings-item :field="$field" />--}}
{{--                        <pre>{{ print_r($field,1) }}</pre>--}}

                @if(1==1)
                    <livewire:board.field-settings-item
                        :field="$field"
                        :board_id="$boardId"
                        :key="$boardId.'-'.$field['pole']"
                    />
                    {{--                :is_enabled="$field['is_enabled'] ?? false"--}}
                    {{--                :show_on_start="$field['show_on_start'] ?? false"--}}
                @endif

                @if(1==2)
                    <div class="flex items-center gap-4 p-4 bg-white rounded-lg shadow">
                        <div class="flex-1">
                            <h3 class="font-medium">{{ !empty($field['name']) ? $field['name'] : $field['pole']?? 'xx нет имени' }}</h3>
                        </div>

                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2">
                                {{ $field['pole'] ?? 'x p' }} //
                                {{ $field['name'] ?? 'x n' }}
                                <input
                                    type="checkbox"
                                    wire:model.live.debounce.500ms="settings.{{ $field['pole'] }}.is_enabled"
                                    class="checkbox"
                                >
                                <span>Включено</span>
                            </label>

                            <label class="flex items-center gap-2">
                                is_enabled: {{ $field['is_enabled'] }}
                                <input
                                    type="checkbox"
                                    wire:model.live.debounce.500ms="settings.{{ $field['pole'] }}.show_on_start"
                                    checked="{{ $field['is_enabled'] ? 1 : 0 }}"
                                    class="checkbox"
                                >
                                <span>Показывать при старте</span>
                            </label>
                        </div>
                    </div>
                @endif

            @endforeach
            </tbody>
        </table>
    </div>

</div>
