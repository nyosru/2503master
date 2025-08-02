<li class="border p-2 rounded flex justify-between items-center">
    <div>
        <strong>{{ $item->name }}</strong> <br/>
        <small class="text-gray-600">{{ $item->comment }}</small><br/>
        <small>Тип: {{ $item->macroType->name ?? '-' }}, Статус: {{ $item->status ?: '-' }}</small>
    </div>
    <div>
        <button wire:click="edit({{ $item->id }})"
                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
            Редактировать
        </button>
    </div>
</li>
