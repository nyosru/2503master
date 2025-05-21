<div class="p-6 bg-white rounded shadow">

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.order_requests_manager','name'=>'Работа с полями в Лиде'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="container mx-auto">


        {{-- Форма добавления/редактирования --}}
        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}"
              class="space-y-4 mb-6 w-[600px] bg-gray-200 p-2 rounded"
        >
            <div>
                <h2>Добавить</h2>
            </div>

            <div>
                <label class="block font-medium">Название</label>
                <input type="text" wire:model.defer="name" class="border rounded p-2 w-full"/>
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Pole <span class="text-red-600">*</span></label>
                <input type="text" wire:model.defer="pole" class="border rounded p-2 w-full" required/>
                @error('pole') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Описание</label>
                <input type="text" wire:model.defer="description" class="border rounded p-2 w-full"/>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="xflex xspace-x-4">

                <label><input type="checkbox" wire:model.defer="string"/> String</label>
                <label><input type="checkbox" wire:model.defer="text"/> Text</label>

                <label><input type="checkbox" wire:model.defer="number"/> Number</label>
                <label><input type="checkbox" wire:model.defer="date"/> Date</label>

                <label><input type="checkbox" wire:model.defer="datetime"/> DateTime</label>
                //
                <label><input type="checkbox" wire:model.defer="nullable"/> Nullable</label>
                <br/>
                <label><input type="checkbox" wire:model.defer="is_web_link"/> Link</label>

            </div>

            <div>
                <label class="block font-medium">Rules</label>
                <input type="text" wire:model.defer="rules" class="border rounded p-2 w-full"/>
                @error('rules') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    {{ $isEditMode ? 'Обновить' : 'Добавить' }}
                </button>
                @if($isEditMode)
                    <button type="button" wire:click="resetInputFields"
                            class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                        Отмена
                    </button>
                @endif
            </div>
        </form>



        {{-- Список --}}
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">ID</th>
                <th class="border border-gray-300 p-2">Название</th>
                <th class="border border-gray-300 p-2">Pole</th>
{{--                <th class="border border-gray-300 p-2">Описание</th>--}}
                <th class="border border-gray-300 p-2">Типы</th>
                <th class="border border-gray-300 p-2">Nullable</th>
                <th class="border border-gray-300 p-2">Правила</th>
                <th class="border border-gray-300 p-2">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orderRequests as $item)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $item->id }}</td>
                    <td class="border border-gray-300 p-2">
                        <b>{{ $item->name }}</b><br/>
                        {{ $item->description }}

{{--                        <pre class="text-xs">{{ print_r($item->toArray()) }}</pre>--}}

                    </td>
                    <td class="border border-gray-300 p-2">{{ $item->pole }}</td>
{{--                    <td class="border border-gray-300 p-2"></td>--}}
                    <td class="border border-gray-300 p-2">

                        @foreach( $item->getAttributes() as $k => $v )
                            @if($k == 'number' && $v )
                                Цифра<br/>
                            @elseif($k == 'date' && $v )
                                Дата<br/>
                            @elseif($k == 'text' && $v )
                                Текст<br/>
                            @elseif($k == 'string' && $v )
                                Строка<br/>
                            @elseif($k == 'is_web_link' && $v )
                                Ссылка<br/>
                            @elseif($k == 'nullable' && $v )
                                Может быть пустым<br/>
                            @endif
                        @endforeach


                    </td>
                    <td class="border border-gray-300 p-2">{{ $item->nullable ? '+' : '' }}</td>
                    <td class="border border-gray-300 p-2">{{ $item->rules }}</td>
                    <td class="border border-gray-300 p-2 space-x-2">
                        <button wire:click="edit({{ $item->id }})"
                                class="bg-yellow-400 px-2 py-1 rounded hover:bg-yellow-500">Редактировать
                        </button>
                        <button wire:click="delete({{ $item->id }})"
                                onclick="confirm('Вы уверены?') || event.stopImmediatePropagation()"
                                class="bg-red-500 px-2 py-1 rounded hover:bg-red-600 text-white">Удалить
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-4 text-center text-gray-500">Записей нет</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orderRequests->links() }}
        </div>
    </div>
</div>
