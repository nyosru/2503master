<div>
    <h3 class="font-semibold mb-2">Колонки</h3>
    <ul class="mb-2">
        @foreach ($columns as $column)
            <li class="flex justify-between items-center mb-1">
                <span>{{ $column['name'] }}</span>
                <span>
                    <span class="text-xs rounded-md bg-gray-200 px-2 py-1 rounded"
                          title="сортировка">{{ $column['sorting'] ?? '-' }}</span>
                    <button
                        wire:click="deleteColumn({{ $column['id'] }})"
                        wire:confirm="Удалить?"
                        class="text-red-600 hover:underline">
                        Удалить
                    </button>
                </span>
            </li>
        @endforeach
    </ul>
    <input type="text" wire:model.defer="newColumnName" placeholder="Новая колонка"
           class="border px-2 py-1 mb-2 w-full"/>
    <input type="number" min="1" max="99" step="1" wire:model.defer="sorting"
{{--           value="50"--}}
           placeholder="сортировка"
           class="border px-2 py-1 mb-2 w-[60px]"/>
    <button wire:click="addColumn" class="bg-green-600 text-white px-4 py-1 rounded">Добавить колонку
    </button>
</div>
