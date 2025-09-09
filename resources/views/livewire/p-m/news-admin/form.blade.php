<div>
    <div class="p-6 bg-white shadow-sm border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $isEdit ? 'Редактирование новости' : 'Создание новости' }}
        </h2>
    </div>

    <form wire:submit="save" class="p-6 space-y-6 bg-white">
        <div class="grid grid-cols-1 gap-6">
            <!-- Заголовок -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Заголовок *</label>
                <input type="text" wire:model="title"
                       class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Краткое описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Краткое описание</label>
                <textarea wire:model="excerpt" rows="3"
                          class="mt-1 block w-full border border-gray-300 rounded-lg p-2"></textarea>
                @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Контент -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Содержание *</label>
                <textarea wire:model="content" rows="10"
                          class="mt-1 block w-full border border-gray-300 rounded-lg p-2"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Изображение -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Изображение</label>
                @if($existingImage)
                    <div class="mt-2 flex items-center gap-4">
                        <img src="{{ asset('storage/news/' . $existingImage) }}"
                             alt="Current image" class="w-32 h-32 object-cover rounded-lg">
                        <button type="button" wire:click="removeImage"
                                class="text-red-600 hover:text-red-800">Удалить</button>
                    </div>
                @else
                    <input type="file" wire:model="image"
                           class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @endif
            </div>

            <!-- Доска -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Привязка к доске</label>
                <select wire:model="board_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                    <option value="">— Без привязки —</option>
                    @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Публикация -->
            <div class="flex items-center gap-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="is_published" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-700">Опубликовать</span>
                </label>

                @if($is_published)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Дата публикации</label>
                        <input type="datetime-local" wire:model="published_at"
                               class="border border-gray-300 rounded-lg p-2">
                    </div>
                @endif
            </div>
        </div>

        <!-- Кнопки -->
        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('tech.news-admin') }}"
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Отмена
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                {{ $isEdit ? 'Обновить' : 'Создать' }}
            </button>
        </div>
    </form>

    <!-- Flash сообщения -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</div>
