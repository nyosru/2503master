<div>
    <form wire:submit="generateQrCode">
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">
                Содержимое QR кода
            </label>
            <input
                type="text"
                id="content"
                wire:model="content"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Введите текст или URL"
            >
            @error('content')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Сгенерировать QR код
        </button>
    </form>

    @if($qrCode)
        <div class="mt-6">
            <h3 class="text-lg font-medium mb-2">Ваш QR код:</h3>
            <img src="{{ $qrCode }}"
                 alt="QR Code"
                 class="mx-auto border rounded">
        </div>
    @endif
</div>
