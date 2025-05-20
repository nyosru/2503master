<tr>
    <td>
        {{--        <pre>{{ print_r($field->toArray(), true) }}</pre>--}}
        <label for="field-{{ $field['pole'] }}">
            <h3 class="font-medium">{{ ( !empty($field['name']) ? $field['name'] : $field['pole'] ) }}</h3>
        </label>
        <small>{{ $field['description'] ?? '' }}</small>
    </td>
    <td>
        @if($is_enabled)
            <livewire:board.config-rename-form :board_id="$board_id" :order_requests_id="$field['id']"/>
        @endif
    </td>
    <td class="text-xs">
        {{$field['number'] ? 'Число' : '' }}
        {{$field['date'] ? 'Дата' : ''}}
        {{$field['text'] ? 'Текст' : ''}}
        {{$field['string'] ? 'Строка' : ''}}
    </td>
    <td class="text-center"><input
            id="field-{{ $field['pole'] }}"
            type="checkbox"
            wire:model.live.debounce.300ms="is_enabled"
            class="checkbox"
        ></td>
    <td class="text-center"><input
            type="checkbox"
            wire:model.live.debounce.300ms="show_on_start"
            class="checkbox"
        ></td>
    <td class="text-center"><input
            type="checkbox"
            wire:model.live.debounce.300ms="in_telega_msg"
            class="checkbox"
        ></td>
    <td class="text-center"><input
            type="number"
            min="0"
            max="99"
            wire:model.live.debounce.300ms="sort_order"
            class="w-16 border rounded px-2 py-1"
        ></td>
</tr>
