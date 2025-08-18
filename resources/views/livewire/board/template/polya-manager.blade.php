<div class="w-full">
    <h2 class="mb-4 text-lg font-bold">Поля шаблона доски</h2>

    <table class="w-full mb-4 border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Название</th>
            <th class="p-2 border">Поле</th>
            <th class="p-2 border">Сортировка</th>
            <th class="p-2 border">Активно</th>
            <th class="p-2 border">Показать в начале</th>
            <th class="p-2 border">В телеге</th>
            <th class="p-2 border">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($polya as $item)
            <tr>
                <td class="border p-2">
                    <b>{{ $item->name }}</b>
                    <br/>{{ $item->description }}
                </td>
                <td class="border p-2">{{ $item->pole }}</td>
                <td class="border p-2">{{ $item->sort }}</td>
                <td class="border p-2">{{ $item->is_enabled ? 'Да' : 'Нет' }}</td>
                <td class="border p-2">{{ $item->show_on_start ? 'Да' : 'Нет' }}</td>
                <td class="border p-2">{{ $item->in_telega_msg ? 'Да' : 'Нет' }}</td>
                <td class="border p-2 text-center">
                    <button wire:click="deletePolya({{ $item->id }})" class="text-red-600 hover:underline">Удалить
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form wire:submit.prevent="addPolya" class="space-y-3 max-w-lg">
        <div>
            <label>Название</label>
            <input type="text" wire:model="name" class="border p-1 w-full"/>
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Описание</label>
            <textarea wire:model="description" class="border p-1 w-full" rows="3"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Поле</label>
            <select wire:model="pole" class="border p-1 w-full">
                <option value="">-- Выберите поле --</option>
                <option value="number1">number1</option>
                <option value="number2">number2</option>
                <option value="number4">number4</option>
                <option value="number5">number5</option>
                <option value="number6">number6</option>
                <option value="date1">date1</option>
                <option value="date2">date2</option>
                <option value="date3">date3</option>
                <option value="date4">date4</option>
                <option value="dt1">dt1</option>
                <option value="dt2">dt2</option>
                <option value="dt3">dt3</option>
                <option value="string1">string1</option>
                <option value="string2">string2</option>
                <option value="string3">string3</option>
                <option value="string4">string4</option>
                <option value="name">name</option>
                <option value="fio">fio</option>
                <option value="phone">phone</option>
                <option value="telegram">telegram</option>
                <option value="whatsapp">whatsapp</option>
                <option value="company">company</option>
                <option value="comment">comment</option>
                <option value="fio2">fio2</option>
                <option value="phone2">phone2</option>
            </select>
            @error('pole') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Сортировка</label>
            <input type="number" wire:model="sort" class="border p-1 w-full" min="0" max="99"/>
            @error('sort') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label><input type="checkbox" wire:model="is_enabled"/> Активно</label>
        </div>
        <div>
            <label><input type="checkbox" wire:model="show_on_start"/> Показать в начале</label>
        </div>
        <div>
            <label><input type="checkbox" wire:model="in_telega_msg"/> В телеге</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Добавить поле</button>
    </form>
</div>
