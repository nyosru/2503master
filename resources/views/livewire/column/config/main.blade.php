<div>

{{--    <pre class="text-xs overflow-auto max-h-[200px]">{{ print_r($column->toArray(),1) }}</pre>--}}
{{--    <pre class="text-xs overflow-auto max-h-[200px]">{{ print_r($column->backgroundColor->toArray(),1) }}</pre>--}}






    <div class="flex flex-row mb-2 space-x-2">

        <div class="w-1/4">
            Название:
        </div>
        <div class="w-3/4">
            <input type="text" wire:model="settings.name" class="w-full"/>
        </div>
    </div>

    @if (session()->has('messageBgUpdaed'))
        <div class="bg-green-300 p-1 rounded"
             x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition
        >{{ session('messageBgUpdaed') }}</div>
    @endif

    <div class="mb-4"
         {{--         x-data="{ bgColor: '' }"--}}
         x-data="{
            selectedColorId: @entangle('selectedColorId'),
            availableColors: @js($availableColors->map(fn($c) => ['id' => $c->id, 'html_code' => $c->html_code])),
            get bgColor() {
                const color = this.availableColors.find(c => c.id == this.selectedColorId);
                return color ? color.html_code : '#fbb';
            }
        }"
    >
        <div :style="`background-color: ${bgColor}`">
            <div class="flex">
                <div class="">
                    <label for="background-color-select" class="inline font-semibold mb-1">Цвет фона</label>
                </div>
                <div class="flex-1">
                    <select
                        id="background-color-select"
                        wire:model.live="selectedColorId"
                        x-model="selectedColorId"
                        class="w-full border rounded px-2">
                        <option value="">-- Выберите цвет --</option>
                        @foreach($availableColors as $color)
                            <option value="{{ $color->id }}">
                                {{ $color->name }} ({{ $color->html_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if(1==2)
                <template x-if="selectedColorId">
                    <div class="mt-2 p-2 rounded border" :style="`background-color: ${bgColor}; color: #000`">
                        Текущий выбранный цвет
                    </div>
                </template>
            @endif
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
