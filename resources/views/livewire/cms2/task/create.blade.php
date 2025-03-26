<div class="p-4 bg-white shadow sm:rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">{{ $taskId ? 'Редактирование задачи' : 'Создание задачи' }}</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-500">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Название задачи</label>
                <input wire:model="name" type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea wire:model="comment" id="comment" name="comment" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                @error('comment') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Дата выполнения</label>
                <input wire:model="date" type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('date') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="time" class="block text-sm font-medium text-gray-700">Время выполнения</label>
                <input wire:model="time" type="time" id="time" name="time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('time') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="lead" class="block text-sm font-medium text-gray-700">Ответственный</label>
                <select wire:model="lead" id="lead" name="lead" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Не выбран</option>
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                    @endforeach
                </select>
                @error('lead') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ $taskId ? 'Обновить задачу' : 'Создать задачу' }}
            </button>
        </div>
    </form>
</div>
