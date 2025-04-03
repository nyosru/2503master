<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                ['route'=>'tech.index','name'=>'Техничка'],
                ['route'=>'board','name'=>'Доски'],
                {{--        [ 'link'=>'no', 'name'=>'Счета']--}}
                ]"/>
    </div>

    <livewire:board.create-form/>

    @if (session()->has('messageBU'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded">
            {{ session('messageBU') }}
        </div>
    @endif
    @if (session()->has('errorBU'))
        <div class="bg-red-100 border border-red-400 text-black-700 px-4 py-3 mb-4 rounded">
            {{ session('errorBU') }}
        </div>
    @endif


    <!-- Список досок -->
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">id</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Оплачено</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пользователи</th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Создано</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>

        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($boards as $board)
            <tr>
                <td class="px-6 py-4">{{ $board->id }}</td>
                <td class="px-6 py-4">{{ $board->name }}
                    {{--                <pre>{{ print_r($board->toArray()) }}</pre>--}}
                </td>
                <td class="px-6 py-4">
                    <input
                        type="checkbox"
                        wire:change="updatePaidStatus({{ $board->id }}, $event.target.checked)"
                        {{ $board->is_paid ? 'checked' : '' }}
                        class="form-checkbox h-5 w-5 text-blue-600"
                    >
                </td>

                <td class="px-6 py-4">
                    <livewire:board.add-user-form :board_id="$board->id"/>

                    <div class=" max-h-[150px]
                            overflow-auto">
                        @foreach($board->boardUsers as $k => $bu)
                            <div
                                class="

{{--                            inline-block --}}
                            bg-gray-100
{{--                            rounded-full--}}
                            px-3 py-1 text-sm
                            font-semibold text-gray-700
                            mb-1
                            ">
                            <span class="@if( !empty($bu->deleted_at) ) line-through @endif">
                                {{ $bu->user->name }}
                                <sup>
                                    {{ $bu->role->name }}
                                </sup>
                            </span>

                                @if( !empty($bu->deleted_at) )
                                    <button class="bg-green-100 hover:bg-green-400 p-1 rounded"
                                            wire:confirm="Восстановить ?" wire:click="restoreBoardUser({{$bu->id}})">вкл
                                    </button>
                                @else
                                    <button class="bg-red-100 hover:bg-red-400 p-1 rounded" wire:confirm="Удалить ?"
                                            wire:click="deleteBoardUser({{$bu->id}})">выкл
                                    </button>
                                @endif

                            </div>

{{--                            <pre class="text-xs">{{ print_r($bu->toArray()) }}</pre>--}}

                        @endforeach
                    </div>
                </td>
                <td class="px-6 py-4">
                    {{ $board->created_at->format('Y-m-d') }}
                    <sup>{{ $board->created_at->format('H:i') }}</sup>
                </td>
                <td class="px-6 py-4">
                    <button
                        wire:confirm="Удалить ?"
                        wire:click="delete({{ $board->id }})"
                        class="
{{--                        bg-red-500 hover:bg-red-700 --}}
                        text-red-200 hover:text-red-500
                        hover:underline
                        font-bold py-2 px-4 rounded"
                    >
                        Удалить
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
