<div>
{{--    <h2>Управление записями</h2>--}}


    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.order.payment-type-manager','name'=>'Заказ: Типы платежей '],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="w-[500px]">
@if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="addRecord">
        <div>
            <label for="name">Название:</label>
            <input type="text" wire:model="name" id="name" class="border rounded p-2" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

{{--        <div>--}}
{{--            <label for="name">Название(для первой версии):</label>--}}
{{--            <input type="text" wire:model="var_to_one" id="var_to_one" class="border rounded p-2" >--}}
{{--            @error('var_to_one') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--        </div>--}}

        <div>
            <label for="name">Предоплата (первый платёж):</label>
            <input type="number" min="0" max="100" step="1" wire:model="prepay" id="name" class="border rounded p-2" >
            @error('prepay') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Добавить</button>
    </form>

    <h3 class="mt-6">Список записей</h3>

    <ul>
        <li class="flex flex-row bg-white mb-1">
            <div class="flex-1">название </div>
{{--            <div class="flex-1"> строка       для первой версии                </div>--}}
            <div class="flex-1">       первая оплата %</div>
            <div class="flex-1">действие
            </div>
        </li>
        @foreach($records as $record)
            <li class="flex flex-row bg-white mb-1">

                <div class="flex-1">                {{ $record->name }}                </div>
{{--                <div class="flex-1">                {{ $record->var_to_one ?? '-' }}                </div>--}}
                <div class="flex-1">                {{ $record->prepay ?? '-' }}                </div>
                <div class="flex-1">
                    <button wire:click="deleteRecord({{ $record->id }})" class="bg-red-500 text-white rounded px-2 py-1">Удалить</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
</div>
