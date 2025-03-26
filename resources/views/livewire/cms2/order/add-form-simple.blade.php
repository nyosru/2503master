<div>

    <label class="block text-gray-700 text-sm">
        Название
        <input type="text" wire:model.live="name"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Дата монтажа
        <input type="date" wire:model.live="montag_date"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Адрес монтажа
        <input type="text" wire:model.live="montag_adres"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Общая стоимость (р)
        <input type="number" min="0" step="1" wire:model.live="price"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Стоимость техники (р)
        <input type="number" min="0" step="1" wire:model.live="amount_tech"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Стоимость камня (р)
        <input type="number" min="0" step="1" wire:model.live="amount_stone"
               class="block mb-2 p-2 border rounded w-full">
    </label>

    <label class="block text-gray-700 text-sm">
        Тип изделия
{{--        <input type="text" wire:model.live="order_type_item"--}}
{{--               class="block mb-2 p-2 border rounded w-full">--}}
        <select wire:model="order_type_item" class="block mb-2 p-2 border rounded w-full">
            <option value="" selected>---</option>
            @foreach ($product_type as $pt)
                <option
                    value="{{ $pt->id }}">{{ $pt->name }}</option>
            @endforeach
        </select>
    </label>

    <label class="block text-gray-700 text-sm">
        Тип оплаты

        <select wire:model="order_type_pay" class="block mb-2 p-2 border rounded w-full">
            <option value="" selected>---</option>
            @foreach ($payment_type as $p)
                <option
                    value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>

    </label>


    <label class="block text-gray-700 text-sm">
        Сумма предоплаты (р)
        <input type="number" min="0" step="0.01" wire:model.live="order_amount_predoplata"
               class="block mb-2 p-2 border rounded w-full">
    </label>


    <label class="block text-gray-700 text-sm">

        Форма оплаты
        <select wire:model="order_type_item" class="block mb-2 p-2 border rounded w-full">
            <option value="" selected>---</option>
            @foreach ($product_type as $pt)
                <option
                    value="{{ $pt->id }}">{{ $pt->name }}</option>
            @endforeach
        </select>

    </label>


    <label class="block text-gray-700 text-sm">
        Cрок изготовления
        <input type="text" wire:model.live="order_sroc_gotov"
               class="block mb-2 p-2 border rounded w-full">
    </label>


    <label class="block text-gray-700 text-sm">
        Гарантийный срок
        <input type="text" wire:model.live="order_sroc_garantiya"
               class="block mb-2 p-2 border rounded w-full">
    </label>


    <label class="block text-gray-700 text-sm">
        Акция для клиента (% скидки)
        <input type="number" wire:model.live="order_akciya_for_client"
               class="block mb-2 p-2 border rounded w-full">
    </label>


    <label class="block text-gray-700 text-sm">
        Комментарий для акции
        <textarea type="text" wire:model.live="order_akciya_comment"
                  class="block mb-2 p-2 border rounded w-full"></textarea>
    </label>

    <label class="block text-gray-700 text-sm">
        Дизайнер
        <input type="text" wire:model.live="order_designer"
               class="block mb-2 p-2 border rounded w-full">
    </label>


</div>
