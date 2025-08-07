<div>


    <div class="flex flex-row mb-2 space-x-2">

        <div class="w-1/4">
            Название:
        </div>
        <div class="w-3/4">
            <input type="text" wire:model="settings.name" class="w-full"/>
        </div>
    </div>


    @foreach ($settings as $key => $value)
        <div class="flex flex-row mb-2 space-x-2">
            <div class="w-3/4 text-right">
                {{ $named[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}:
            </div>
            <div class="w-1/4">
                <input type="checkbox" wire:model="settings.{{ $key }}"
                       @if($value) checked @endif />
            </div>
        </div>
    @endforeach

    <!-- Сообщение об ошибке -->
    @if (session()->has('error'))
        <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </span>
    @endif

    <!-- Сообщение об ошибке -->
    @if (session()->has('CfgMainSuccess'))
        <span class="bg-green-200 text-black p-2 rounded mb-4">
            {{ session('CfgMainSuccess') }}
        </span>
    @endif

    <div class="text-center mt-4">
{{--        <button type="button" wire:click="$set('modal_show', false)"--}}
{{--                class="bg-gray-500 text-white py-1 px-4 rounded mr-2">--}}
{{--            Закрыть--}}
{{--        </button>--}}
        <button type="button" wire:click="saveColumnConfig" class="bg-blue-500 text-white py-1 px-4 rounded">
            Сохранить
        </button>
    </div>

</div>
