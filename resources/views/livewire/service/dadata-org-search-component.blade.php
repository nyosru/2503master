<div>

    <form wire:submit.prevent="search" class="mb-4">
        <input type="text" wire:model="inn" placeholder="Введите ИНН" class="border rounded p-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Найти</button>
    </form>

    {{-- Индикатор загрузки --}}
    <div wire:loading wire:target="search" class="mb-4 text-blue-600 font-semibold">
        Загрузка...
    </div>


@if($error)
        <div class="text-red-600 mb-2">{{ $error }}</div>
    @endif

    @if($orgData)
        <div class="p-4 bg-gray-100 rounded">
            <div><b>Название:</b> {{ $orgData['name']['full_with_opf'] ?? '-' }}</div>
            <div><b>ИНН:</b> {{ $orgData['inn'] ?? '-' }}</div>
            <div><b>ОГРН:</b> {{ $orgData['ogrn'] ?? '-' }}</div>
            <div><b>Адрес:</b> {{ $orgData['address']['value'] ?? '-' }}</div>
            {{-- Добавьте другие поля, если нужно --}}
        </div>
    @endif
</div>
