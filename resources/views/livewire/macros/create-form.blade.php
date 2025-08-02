<div>

    @if (session()->has('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif


    {{-- Форма добавления нового макроса --}}
    @if (is_null($editingMacroId))

        {{--        @if( is_array($columns) && sizeof($columns) > 0)--}}
        <h2 class="mb-4 font-bold text-xl">Добавить новый макрос</h2>

        @if( empty($columns) )

            <div class="bg-yellow-200 p-3 rounded">для добавления макроса, выберите Доску</div>

        @else
            <form wire:submit.prevent="addMacro" class="space-y-4">

                <div>
                    <label class="block font-semibold mb-1" for="type_id">Тип макроса *</label>
                    <select id="type_id" wire:model.defer="type_id" class="w-full p-2 border rounded">
                        <option value="">-- Выберите тип --</option>
                        @foreach($macroTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Выберите колонки</label>
                    <div class="flex flex-wrap gap-2 max-h-40 overflow-y-auto border p-2 rounded">
                        @if( !empty($columns) )
                            @foreach($columns as $column)
                                <label class="inline-flex items-center space-x-2">
                                    <input type="checkbox"
                                           wire:model.defer="column_ids"
                                           value="{{ $column->id }}"
                                           class="form-checkbox"/>
                                    <span>{{ $column->name }}</span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                    @error('column_ids')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>


                <div>
                    <label class="block font-semibold mb-1" for="name">Название макроса *</label>
                    <input id="name" type="text" wire:model.defer="name" class="w-full p-2 border rounded"/>
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-1" for="comment">Комментарий</label>
                    <textarea id="comment" wire:model.defer="comment" rows="3"
                              class="w-full p-2 border rounded"></textarea>
                    @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-1" for="status">Статус</label>
                    <input id="status" type="text" wire:model.defer="status" class="w-full p-2 border rounded"/>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Добавить макрос
                </button>
            </form>

        @endif

    @else
        {{-- Форма редактирования макроса --}}
        <h2 class="mb-4 font-bold text-xl">Редактировать макрос (ID: {{ $editingMacroId }})</h2>
        <form wire:submit.prevent="updateMacro" class="space-y-4">

            <div>
                <label class="block font-semibold mb-1" for="editingTypeId">Тип макроса *</label>
                <select id="editingTypeId" wire:model.defer="editingTypeId" class="w-full p-2 border rounded">
                    <option value="">-- Выберите тип --</option>
                    @foreach($macroTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('editingTypeId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Выберите колонки</label>
                <div class="flex flex-wrap gap-2 max-h-40 overflow-y-auto border p-2 rounded">
                    @foreach($columns as $column)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox"
                                   wire:model.defer="editingColumnIds"
                                   value="{{ $column->id }}"
                                   class="form-checkbox"/>
                            <span>{{ $column->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('editingColumnIds')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="editingName">Название макроса *</label>
                <input id="editingName" type="text" wire:model.defer="editingName" class="w-full p-2 border rounded"/>
                @error('editingName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="editingComment">Комментарий</label>
                <textarea id="editingComment" wire:model.defer="editingComment" rows="3"
                          class="w-full p-2 border rounded"></textarea>
                @error('editingComment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="editingStatus">Статус</label>
                <input id="editingStatus" type="text" wire:model.defer="editingStatus"
                       class="w-full p-2 border rounded"/>
                @error('editingStatus') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Сохранить изменения
                </button>
                <button type="button" wire:click="cancelEdit"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Отмена
                </button>
            </div>
        </form>
    @endif

</div>
