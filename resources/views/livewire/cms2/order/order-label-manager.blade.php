<div class="p-4 xbg-white xrounded-lg xshadow">

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'order.label','name'=>'Управление метками заказов'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <!-- Форма добавления новой метки -->
    <form wire:submit.prevent="createLabel" class="mb-4 flex flex-col gap-2">
        <div class="flex flex-row space-x-2 bg-orange-300 p-2 rounded">
            <div class="w-[250px]">
                <input type="text" wire:model="name" class="border rounded p-2 w-full" placeholder="Название метки">
            </div>
            <div class="flex items-center gap-2 w-[250px]">
                фон: <input type="color" wire:model="color" class="border rounded">
                текст: <input type="color" wire:model="textColor" class="border rounded">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Добавить</button>
            </div>
        </div>
    </form>

    <!-- Список меток -->
    @foreach ($labels as $label)
        <div class="w-[250px] p-3 bg-white shadow rounded mr-1 mb-1 inline-block">
            <button wire:click="deleteLabel({{ $label->id }})" class="text-red-500 float-right"
                    wire:confirm="Удалить метку ?">х
            </button>
            <span class="p-2 inline-block rounded" style="background: {{ $label->color }}; color: {{ $label->text_color }};">
                    {{ $label->name }}
                </span>
        </div>
        @endforeach
        </ul>
</div>
