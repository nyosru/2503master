<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-xl font-semibold mb-4">Цвета фона колонок</h2>

    {{-- Список цветов --}}
    <table class="w-full border-collapse border border-gray-300 mb-6">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Имя</th>
            <th class="border border-gray-300 px-4 py-2 text-left">HTML Код</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Tailwind классы</th>
            <th class="border border-gray-300 px-4 py-2 text-left">CSS стиль</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($colors as $color)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $color->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $color->name }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <span class="inline-block w-6 h-6" style="background-color: {{ $color->html_code }};"></span>
                    {{ $color->html_code }}
                </td>
                <td class="border border-gray-300 px-4 py-2">{{ $color->tailwind_classes }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $color->style_string }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <button wire:click="edit({{ $color->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center p-4">Список пуст</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Форма добавления/редактирования --}}
    <div class="border border-gray-300 p-4 rounded shadow-sm bg-white">
        <h3 class="text-lg font-medium mb-4">
            {{ $isEditing ? 'Редактирование цвета' : 'Добавить новый цвет' }}
        </h3>

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Имя</label>
                <input type="text" id="name" wire:model.defer="name" class="w-full border border-gray-300 rounded px-3 py-2">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="html_code" class="block font-semibold mb-1">HTML код (например, #ff0000)</label>
                <input type="text" id="html_code" wire:model.defer="html_code" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="#rrggbb">
                @error('html_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="tailwind_classes" class="block font-semibold mb-1">Tailwind классы</label>
                <input type="text" id="tailwind_classes" wire:model.defer="tailwind_classes" class="w-full border border-gray-300 rounded px-3 py-2">
                @error('tailwind_classes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="style_string" class="block font-semibold mb-1">CSS стиль</label>
                <input type="text" id="style_string" wire:model.defer="style_string" class="w-full border border-gray-300 rounded px-3 py-2">
                @error('style_string') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ $isEditing ? 'Обновить' : 'Добавить' }}
                </button>
                @if($isEditing)
                    <button type="button" wire:click="resetInput" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Отмена
                    </button>
                @endif
            </div>
        </form>
    </div>
    <div class="hidden bg-gradient-to-r from-yellow-400 to-blue-600"></div>
</div>
