<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :board_id="$board->id"
            :menu="[

                        ['route'=>'leed.list','name'=>'Рабочие доски'],

                        [
                            'route'=>'leed',
{{--                            'route-var'=>['board_id'=>$board->id ?? ''],--}}
                            'name'=> $board->name
    {{--                                        'name'=>( $user->currentBoard->name ?? 'x' ).( $user->roles[0]['name'] ? ' <sup>'.$user->roles[0]['name'].'</sup>' : '-' )--}}
                        ],

                        [
                        'route'=>'board.config',
{{--                        'route-var'=>['board'=>$board->id ?? ''],--}}
                        'route-var'=>['board'=>$board ?? ''],
                        'name'=>'Конфигурация',
{{--                        'link'=>'no'--}}
                        ],

                        [
                        'name'=>'Макросы',
                        'route'=>'board.config.macros',
                        'route-var'=>['board'=>$board ?? ''],
{{--                        'link'=>'no'--}}
                        ],

                    ]"/>
    </div>

    @if(1==2)
        <div>
            <h2 class="text-xl font-semibold mb-4">Управление макросами</h2>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'create' }}"
                  class="mb-6 bg-white p-4 rounded shadow">
                <div class="mb-4">
                    <label for="name" class="block font-medium mb-1">Название макроса</label>
                    <input type="text" id="name" wire:model.defer="name" class="w-full border rounded px-3 py-2"/>
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

{{--                <div class="mb-4">--}}
{{--                    <label for="column_id" class="block font-medium mb-1">Колонка</label>--}}
{{--                    <select id="column_id" wire:model.defer="column_id" class="w-full border rounded px-3 py-2">--}}
{{--                        <option value="">-- Выберите колонку --</option>--}}
{{--                        @foreach($columns as $column)--}}
{{--                            <option value="{{ $column->id }}">{{ $column->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @error('column_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror--}}
{{--                </div>--}}

                <div class="mb-4">
                    <label class="block font-medium mb-1">Связанные колонки</label>
                    <select multiple wire:model="selectedColumns" class="w-full border rounded px-3 py-2">
                        @foreach($allColumns as $column)
                            <option value="{{ $column->id }}">{{ $column->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="leed_id" class="block font-medium mb-1">Лид</label>
                    <select id="leed_id" wire:model.defer="leed_id" class="w-full border rounded px-3 py-2">
                        <option value="">-- Выберите лид --</option>
                        @foreach($leeds as $leed)
                            <option value="{{ $leed->id }}">{{ $leed->name }}</option>
                        @endforeach
                    </select>
                    @error('leed_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="block font-medium mb-1">Тип</label>
                    {{--                <input type="text" id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2" />--}}
                    {{--                <input type="text" id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2" />--}}
                    <select id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2">
                        <option value="">-- Выберите тип --</option>
                        <option value="alarm_timer">тревога если пауза</option>
                    </select>
                    @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="to_telegrams" class="block font-medium mb-1">Телеграмы для отправки</label>
                    <input type="text" id="to_telegrams" wire:model.defer="to_telegrams"
                           class="w-full border rounded px-3 py-2"/>
                    @error('to_telegrams') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="message" class="block font-medium mb-1">Сообщение</label>
                    <textarea id="message" wire:model.defer="message"
                              class="w-full border rounded px-3 py-2"></textarea>
                    @error('message') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="day" class="block font-medium mb-1">День (число)</label>
                    <input type="number" id="day" wire:model.defer="day" class="w-full border rounded px-3 py-2"/>
                    @error('day') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="comment" class="block font-medium mb-1">Комментарий</label>
                    <textarea id="comment" wire:model.defer="comment"
                              class="w-full border rounded px-3 py-2"></textarea>
                    @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        {{ $isEditMode ? 'Обновить' : 'Добавить' }}
                    </button>
                    @if($isEditMode)
                        <button type="button" wire:click="resetInput"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Отмена
                        </button>
                    @endif
                </div>
            </form>

            <hr class="my-6"/>

            <h3 class="text-lg font-semibold mb-3">Список макросов</h3>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 text-left">Название</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Тип</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Телеграмы</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Сообщение</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">День</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Комментарий</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($macroses as $macro)
                    <tr>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->name }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->type }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->to_telegrams }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->message }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->day }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $macro->comment }}</td>
                        <td class="border border-gray-300 px-3 py-2 space-x-2">
                            <button wire:click="edit({{ $macro->id }})"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Редактировать
                            </button>
                            <button wire:click="delete({{ $macro->id }})"
                                    class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
                                    onclick="confirm('Вы уверены?') || event.stopImmediatePropagation()">Удалить
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Макросы не найдены.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endif


    <div x-data="{ showForm: @entangle('isEditMode').defer }" class="space-y-4">
        <h2 class="text-xl font-semibold mb-4">Управление макросами</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Кнопка для показа формы добавления -->
        <button
            x-show="!showForm"
            @click="showForm = true"
            type="button"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
            Добавить
        </button>

        <!-- Форма добавления/редактирования -->
        <form
            x-show="showForm"
            x-transition
            wire:submit.prevent="{{ $isEditMode ? 'update' : 'create' }}"
            class="bg-white p-4 rounded shadow"
            @keydown.escape.window="showForm = false; @this.resetInput()"
        >
{{--            <div class="mb-4">--}}
{{--                <label for="column_id" class="block font-medium mb-1">Колонка</label>--}}
{{--                <select id="column_id" wire:model.defer="column_id" class="w-full border rounded px-3 py-2">--}}
{{--                    <option value="">-- Выберите колонку --</option>--}}
{{--                    @foreach($columns as $column)--}}
{{--                        <option value="{{ $column->id }}">{{ $column->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @error('column_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror--}}
{{--            </div>--}}


            <div class="mb-4">
                <label class="block font-medium mb-1">Связанные колонки</label>
                <select multiple wire:model="selectedColumns" class="w-full border rounded px-3 py-2">
                    @foreach($allColumns as $column)
                        <option value="{{ $column->id }}">{{ $column->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-4">
                <label for="leed_id" class="block font-medium mb-1">Лид</label>
                <select id="leed_id" wire:model.defer="leed_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Выберите лид --</option>
                    @foreach($leeds as $leed)
                        <option value="{{ $leed->id }}">{{ $leed->name }}</option>
                    @endforeach
                </select>
                @error('leed_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Название макроса</label>
                <input type="text" id="name" wire:model.defer="name" class="w-full border rounded px-3 py-2"/>
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{--            <div class="mb-4">--}}
            {{--                <label for="type" class="block font-medium mb-1">Тип</label>--}}
            {{--                <input type="text" id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2" />--}}
            {{--                @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror--}}
            {{--            </div>--}}

            <div class="mb-4">
                <label for="type" class="block font-medium mb-1">Тип</label>
                {{--                <input type="text" id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2" />--}}
                {{--                <input type="text" id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2" />--}}
                <select id="type" wire:model.defer="type" class="w-full border rounded px-3 py-2">
                    <option value="">-- Выберите тип --</option>
                    <option value="alarm_timer">тревога если пауза</option>
                </select>
                @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Поле выбора ролей -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Роли</label>
                <div class="space-y-2">

{{--                    <pre class="text-xs max-h-[200px] overflow-auto" >{{ print_r($allRoles,1) }}</pre>--}}

                    @foreach($allRoles as $role)

{{--                        <pre class="text-xs max-h-[200px] overflow-auto" >{{ print_r($role->toArray(),1) }}</pre>--}}

                        <label class="flex items-center space-x-2">
                            <input
                                type="checkbox"
                                wire:model="selectedRoles"
                                value="{{ $role->id }}"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            >
                            <span>{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('selectedRoles') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <div class="mb-4">
                <label for="to_telegrams" class="block font-medium mb-1">Телеграмы для отправки</label>
                <input type="text" id="to_telegrams" wire:model.defer="to_telegrams"
                       class="w-full border rounded px-3 py-2"/>
                @error('to_telegrams') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block font-medium mb-1">Сообщение</label>
                <textarea id="message" wire:model.defer="message" class="w-full border rounded px-3 py-2"></textarea>
                @error('message') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="day" class="block font-medium mb-1">День (число)</label>
                <input type="number" id="day" wire:model.defer="day" class="w-full border rounded px-3 py-2"/>
                @error('day') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="comment" class="block font-medium mb-1">Комментарий</label>
                <textarea id="comment" wire:model.defer="comment" class="w-full border rounded px-3 py-2"></textarea>
                @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ $isEditMode ? 'Обновить' : 'Добавить' }}
                </button>
                <button
                    type="button"
                    @click="showForm = false; $wire.resetInput()"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Отмена
                </button>
            </div>
        </form>

        <hr class="my-6"/>

        <h3 class="text-lg font-semibold mb-3">Список макросов</h3>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                {{--                <th class="border border-gray-300 px-3 py-2 text-left">Название</th>--}}
                <th class="border border-gray-300 px-3 py-2 text-left">Где работает</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Описание</th>
{{--                <th class="border border-gray-300 px-3 py-2 text-left">Тип</th>--}}
                <th class="border border-gray-300 px-3 py-2 text-left">Телеграмы (Роли)</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Сообщение</th>
{{--                <th class="border border-gray-300 px-3 py-2 text-left">День</th>--}}
                <th class="border border-gray-300 px-3 py-2 text-left">Комментарий</th>
                <th class="border border-gray-300 px-3 py-2 text-left">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($macroses as $macro)
                <tr>
                    {{--                    <td class="border border-gray-300 px-3 py-2">{{ $macro->name }}</td>--}}
                    <td class="border border-gray-300 px-3 py-2">
{{--                        Колонка: {{ $macro->column->name ?? '-' }}--}}
                        @foreach($macro->columns as $column)
                            <div class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded mr-1">
            колонка {{ $column->name }}
        </div>
                        @endforeach
                        <br/>
                        Лид: {{ $macro->leed->name ?? '-' }}
                    </td>
                    <td class="border border-gray-300 px-3 py-2">
                        @if( $macro->type === 'alarm_timer' )
                            Если не&nbsp;было никаких коментариев и&nbsp;движений в&nbsp;лиде в&nbsp;колонке {{ $macro->column->name ?? '-' }} более&nbsp;{{ $macro->day }}&nbsp;дней
                        <br/>
                            Отправить сообщение в&nbsp;телеграм
                        @endif
                    </td>
{{--                    <td class="border border-gray-300 px-3 py-2">{{ $macro->type }}</td>--}}
                    <td class="border border-gray-300 px-3 py-2">{{ $macro->to_telegrams }}
                        @foreach($macro->roles as $role)
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-3 py-2">{{ $macro->message }}</td>
{{--                    <td class="border border-gray-300 px-3 py-2">{{ $macro->day }}</td>--}}
                    <td class="border border-gray-300 px-3 py-2">{{ $macro->comment }}</td>
                    <td class="border border-gray-300 px-3 py-2 space-x-2">
                        <button
                            wire:click="edit({{ $macro->id }})"
                            @click="showForm = true"
                            class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600"
                        >
                            Редактировать
                        </button>
                        <button
                            wire:click="delete({{ $macro->id }})"
                            class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
{{--                            onclick="confirm('Вы уверены?') || event.stopImmediatePropagation()"--}}
                            wire:confirm="Вы уверены, что хотите удалить этот макрос?"
                        >
                            Удалить
                        </button>
                    </td>
                </tr>

                @if(1==2)
                <tr>
                    <td colspan="7" class="border-b border-gray-300">
                        <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($macro->toArray(), true) }}</pre>
                    </td>
                </tr>
                @endif

            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Макросы не найдены.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


</div>
