<div>
    <h3 class="font-semibold mb-3">Какие должности видят этот столбец</h3>

    <table class="table-auto border-collapse border border-gray-300 w-full md:w-[400px]">
        <thead>
        <tr>
            <th class="border border-gray-300 px-2 py-1">Должность</th>
            <th class="border border-gray-300 px-2 py-1">Видно?</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td class="border border-gray-300 px-2 py-1">{{ $role->name_ru }}</td>
                <td class="border border-gray-300 px-2 py-1 text-center">
                    <input type="checkbox" wire:model.defer="accesses.{{ $role->id }}"
                           wire:change="$set('accesses.{{ $role->id }}', $event.target.checked)"
                           onchange="this.dispatchEvent(new InputEvent('input'))"
                    />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
