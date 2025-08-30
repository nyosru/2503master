<div>


    <div class="flex flex-row mb-2 space-x-2">

        <div class="w-1/4">
            Название:
        </div>
        <div class="w-3/4">
            <input type="text" wire:model="settings.name" class="w-full p-2 border rounded"/>
        </div>
    </div>

    <!-- Поля для цветов -->
    <div class="flex flex-row mb-2 space-x-2">
        <div class="w-1/4">
            Цвет фона:
        </div>
        <div class="w-3/4 flex items-center space-x-2">
            <input type="color" wire:model="settings.bg_color" class="w-10 h-10 p-0 border rounded"/>
            <input type="text" wire:model="settings.bg_color" class="w-20 p-1 border rounded text-sm"/>
            <span class="text-xs text-gray-500">HEX</span>
        </div>
    </div>

    <div class="flex flex-row mb-2 space-x-2">
        <div class="w-1/4">
            Цвет обводки:
        </div>
        <div class="w-3/4 flex items-center space-x-2">
            <input type="color" wire:model="settings.border_color" class="w-10 h-10 p-0 border rounded"/>
            <input type="text" wire:model="settings.border_color" class="w-20 p-1 border rounded text-sm"/>
            <span class="text-xs text-gray-500">HEX</span>
        </div>
    </div>

    @foreach ($settings as $key => $value)
        @if(!in_array($key, ['name', 'bg_color', 'border_color']))
            <div class="flex flex-row mb-2 space-x-2">
                <div class="w-3/4 text-right">
                    {{ $named[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}:
                </div>
                <div class="w-1/4">
                    <input type="checkbox" wire:model="settings.{{ $key }}"
                           @if($value) checked @endif />
                </div>
            </div>
        @endif
    @endforeach

    <!-- Сообщение об ошибке -->
    @if (session()->has('error'))
        <span class="bg-red-100 text-red-800 p-2 rounded mb-4 block">
            {{ session('error') }}
        </span>
    @endif

    <!-- Сообщение об ошибке -->
    @if (session()->has('CfgMainSuccess'))
        <span class="bg-green-200 text-black p-2 rounded mb-4 block">
            {{ session('CfgMainSuccess') }}
        </span>
    @endif

    <div class="text-center mt-4">
        <button type="button" wire:click="saveColumnConfig" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
            Сохранить
        </button>
    </div>

</div>
