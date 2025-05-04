<div x-data="{ isFormVisible: false }"
     @form-saved.window="isFormVisible = false"
>

    <button
        x-on:click="isFormVisible = !isFormVisible"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
    >
        +
    </button>

    <!-- Уведомление об успешном добавлении -->
    @if (session()->has('message'.$board_id))
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded"
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
        >
            {{ session('message'.$board_id) }}
        </div>
    @endif


    <!-- Форма -->
    <form wire:submit.prevent="save" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
          x-show="isFormVisible"
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 transform scale-95"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-95"

    >

        <!-- Доска -->
        @if(1==2)
        <div class="mb-4">
            <label for="board_id" class="block text-gray-700 text-sm font-bold mb-2">Доска:</label>
            <select
                wire:model="board_id"
                id="board_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="">Выберите доску</option>
                @foreach($boards as $board)
                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                @endforeach
            </select>
            @error('board_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
@endif
        <!-- Пользователь -->
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Пользователь:</label>
            <select
                wire:model="user_id"
                id="user_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="">Выберите пользователя</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Роль -->
        <div class="mb-4">
            <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Роль:</label>
            <select
                wire:model="role_id"
                id="role_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="">Выберите роль</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Кнопка отправки -->
        <div class="flex items-center justify-between">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Добавить
            </button>
        </div>
    </form>
</div>
