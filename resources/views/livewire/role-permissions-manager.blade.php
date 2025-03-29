<div>
    <!-- Форма для добавления новой роли -->
    <div class="m-4 bg-green-100 p-4 rounded-lg w-[400px] shadow-md">
        <h3>Добавить новую роль</h3>
        <form wire:submit.prevent="addRole">
            <div class="mb-2">
                <label for="newRoleName" class="block text-sm font-medium text-gray-700">Название роли</label>
                <input type="text" id="newRoleName" wire:model="newRoleName" class="mt-1 block w-full" required>
                @error('newRoleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Добавить роль</button>
        </form>
    </div>
</div>
