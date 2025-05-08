<div class="bg-white p-6 rounded-lg shadow-sm">
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Сумма</label>
            <input
                type="number"
                step="0.01"
                wire:model="amount"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="0.00"
                required
            >
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Дата операции</label>
            <input
                type="datetime-local"
                wire:model="operation_date"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Комментарий</label>
            <textarea
                wire:model="comment"
                rows="2"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Дополнительная информация"
            ></textarea>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors"
        >
            Добавить платёж
        </button>
    </form>
</div>
