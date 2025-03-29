<div>
    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.order.product-type-manager','name'=>'Типы изделий'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="w-[600px] mx-auto">
        <h2>Управление типами заказа</h2>

        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="addProductType"
        class="flex flex-row">

            <div>
                <label for="name">Название:</label>
                <input type="text" wire:model="name" id="name" class="border rounded p-2" required>
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="name">Сортировка:</label>
                <input type="number" min="1" max="99" step="1" wire:model="order" id="order" class="border rounded p-2"
                       required>
                @error('order') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

{{--            <div>--}}
{{--                <label for="types">Тип:</label>--}}
{{--                <input type="text" wire:model="types" id="types" class="border rounded p-2">--}}
{{--                @error('types') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--            </div>--}}

            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Добавить</button>
        </form>

        <h3 class="mt-6 bg-gray-200 p-2 mb-3">Список типов</h3>

        <ul>
            @foreach($productTypes as $productType)
                <li class="flex justify-between items-center bg-white mb-1">
                    {{ $productType->name }} ({{ $productType->types }}) {{ $productType->order }}
                    <button wire:confirm="Удалить ?" wire:click="deleteProductType({{ $productType->id }})"
                            class="bg-red-500 text-white rounded px-2 py-1">Удалить
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
