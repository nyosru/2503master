<span class="bg-white p-2 rounded shadow w-[400px]">

    <form wire:submit.prevent="save"
          class="flex flex-col space-y-2"
    >
    <div class="font-bold">
        Cоздать первый столбец <span class="text-gray-500">(этап работы)</span>
    </div>

        <div>
            <input type="text" class="w-full" wire:model="name" placeholder="Название столбца">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-400 px-2 py-1 rounded">Создать</button>
        </div>
    </form>
</span>
