<div>
    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                ['route'=>'tech.index','name'=>'Техничка'],
                [ 'link'=>'no', 'name'=>'Автоматизация']
                ]"/>

    </div>

    <div class="space-y-6">

        <form wire:submit.prevent="addRule" class="bg-white p-6 rounded shadow-md space-y-4">
            <!-- Выбор доски -->
            <div>
                <label>Доска</label>
                <select wire:model.live="board_id" class="w-full border rounded p-2">
                    <option value="">Выберите доску</option>
                    @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                    @endforeach
                </select>
                @error('board_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            @if($board_id)

            <!-- Выбор исходной и целевой колонки -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Исходная колонка</label>
                    <select wire:model="source_column_id" class="w-full border rounded p-2">
                        <option value="">Не указано</option>
                        @foreach($columns as $column)
                            <option value="{{ $column->id }}">{{ $column->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Целевая колонка</label>
                    <select wire:model="target_column_id" class="w-full border rounded p-2">
                        <option value="">Не указано</option>
                        @foreach($columns as $column)
                            <option value="{{ $column->id }}">{{ $column->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Основные параметры -->
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label>Действие</label>
                    <input type="text" wire:model="action"
                           class="w-full border rounded p-2" placeholder="Название действия">
                    @error('action') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label>Задержка (дней)</label>
                    <input type="number" wire:model="delay_days"
                           class="w-full border rounded p-2" min="0">
                </div>

                <div class="flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="is_active" class="mr-2">
                        Активно
                    </label>
                </div>
            </div>

            <!-- Дополнительные поля -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>String 1</label>
                    <input type="text" wire:model="string1"
                           class="w-full border rounded p-2" placeholder="Доп. строка 1">
                </div>

                <div>
                    <label>String 2</label>
                    <input type="text" wire:model="string2"
                           class="w-full border rounded p-2" placeholder="Доп. строка 2">
                </div>

                <div>
                    <label>Integer 1</label>
                    <input type="number" wire:model="integer1"
                           class="w-full border rounded p-2" min="0">
                </div>

                <div>
                    <label>Integer 2</label>
                    <input type="number" wire:model="integer2"
                           class="w-full border rounded p-2" min="0">
                </div>
            </div>

            <button type="submit"
                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Добавить правило
            </button>
            @endif
        </form>

        <!-- Список правил -->
        <div class="bg-white p-6 rounded shadow-md">
            <h3 class="text-xl font-semibold mb-4">Активные правила</h3>

            <div class="space-y-4">
                @foreach($rules as $rule)
                    <div class="p-4 border rounded hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold">{{ $rule->action }}</div>
                                <div class="text-sm text-gray-600">
                                    @if($rule->sourceColumn)
                                        {{ $rule->sourceColumn->name }} →
                                    @endif
                                    @if($rule->targetColumn)
                                        {{ $rule->targetColumn->name }}
                                    @endif
                                    @if($rule->delay_days)
                                        (через {{ $rule->delay_days }} дней)
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button wire:click="deleteRule({{ $rule->id }})"
                                        class="text-red-600 hover:text-red-800">
                                    {{--                                <x-heroicon-o-trash class="w-5 h-5"/>--}}
                                    <x-heroicon-o-trash class="w-5 h-5 text-red-600"/>

                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
