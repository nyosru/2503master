<div
@if( !$show_form )
x-data="{ isFormVisible: false }"
@endif
>

    @if( !$show_form )
<button
    x-on:click="isFormVisible = !isFormVisible"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
>
    Добавить доску
</button>
    @endif

<!-- Форма для добавления доски -->
<form
    wire:submit.prevent="save"
    class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6 flex flex-row items-end space-x-3 w-[600px]"
    @if( !$show_form )
    x-show="isFormVisible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    @endif
>

    <div class="w-[300px] mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Название доски:</label>
        <input type="text" id="name" wire:model="name"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               required>
    </div>

    @if(1==2)
    <div class="mb-4">
        <label for="selectedUsers" class="block text-gray-700 text-sm font-bold mb-2">Пользователи:</label>
        @foreach($users as $user)
            <div class="mb-2" x-data="{ isSelected: false }">
                <input
                    type="checkbox"
                    wire:model="selectedUsers"
                    value="{{ $user->id }}"
                    id="user_{{ $user->id }}"
                    class="form-checkbox h-5 w-5 text-blue-600"
                    x-on:click="isSelected = !isSelected"
                >
                <label for="user_{{ $user->id }}" class="ml-2">{{ $user->name }}</label>
                <div class="inline" x-show="isSelected" x-transition>
                    <select
                        wire:model="userRoles.{{ $user->id }}"
                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="">Выберите роль</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    @if($show_payes)
    <div class="w-[150px] mb-4">
        <label for="is_paid" class="block text-gray-700 text-sm font-bold mb-2">
            <input type="checkbox" id="is_paid" wire:model="is_paid" class="form-checkbox h-5 w-5 text-blue-600"> Оплачено
        </label>
    </div>
    @endif

    <div class="w-[200px] mb-4">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Добавить
    </button>
        </div>
</form>

</div>
