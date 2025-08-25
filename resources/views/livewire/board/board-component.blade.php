<div class="container mx-auto">
    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                ['route'=>'tech.index','name'=>'Техничка'],
                ['route'=>'board.list','name'=>'Доски'],
                {{--        [ 'link'=>'no', 'name'=>'Счета']--}}
                ]"/>
    </div>

    <livewire:board.create-form/>

    <div x-data="{ showListTemplate: false }">

        <div class="text-right mr-5">
            <button @click="showListTemplate = !showListTemplate"
                    {{--            class="float-right"--}}
                    class="bg-blue-300 hover:bg-blue-500 text-white font-bold py-1 px-3 rounded-md mb-4 "
            >Добавить доску (по шаблону)
            </button>
        </div>

        <div x-show="showListTemplate"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="bg-white shadow-md rounded-lg p-6 mb-4"
        >
            <div class="w-full">
                <h2 class="text-lg my-2 text-center">создать доску по шаблону</h2>
                <livewire:Board.CreateShablonForm/>
            </div>
        </div>

    </div>


    @if (session()->has('messageBU'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded">
            {{ session('messageBU') }}
        </div>
    @endif
    @if (session()->has('deleteOkMessage'))
        <div class="bg-yellow-300 border border-green-400 border-3 text-green-700 px-4 py-3 mb-4 rounded">
            {{ session('deleteOkMessage') }}
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

{{--            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">id</th>--}}
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Войти как</th>

            @permission('р.Доски / может изменять "оплачено"')
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Оплачено</th>
            @endpermission
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пользователи</th>

            @permission('р.Доски / доп.инфа')
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Создано</th>
            @endpermission
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>

        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($boards as $board)
            <tr wire:key="tr_board_'.$board->id">
{{--                <td class="px-6 py-4">{{ $board->id }}</td>--}}
                <td class="px-6 py-4">{{ $board->name }}
                    {{--                <pre>{{ print_r($board->toArray()) }}</pre>--}}
                </td>
                <td class="px-6 py-4">
                    @if(!empty($board->boardUsers) )
                        @foreach($board->boardUsers as $ba )
{{--                            @if($ba->deleted_at) @continue @endif--}}
                            @if($ba->user_id != Auth()->user()->id) @continue @endif
{{--                        <pre>{{ print_r($ba->toArray(),1) }}</pre>--}}
                            {{--                                    <pre class="text-xs">{{ print_r($ba['role']->toArray(),1) }}</pre>--}}

                            <a href="{{ route('leed.goto',[
                                'board_id'=>$board->id,
                                'role_id'=>$ba->role->id
                                ]) }}"
                               class="text-blue-700
                               bg-blue-100
                               hover:bg-blue-200
                               m-2 py-1 px-2
                               border border-bottom-3 border-black
                               rounded"
                            >
                                {{ ( $ba['role']['name_ru'] ?? $ba['role']['name'] ) }}
                            </a>
                        @endforeach
                    @endif
                </td>
                @permission('р.Доски / может изменять "оплачено"')
                <td class="px-6 py-4">
                    <input
                        type="checkbox"
                        wire:change="updatePaidStatus({{ $board->id }}, $event.target.checked)"
                        {{ $board->is_paid ? 'checked' : '' }}
                        class="form-checkbox h-5 w-5 text-blue-600"
                    >
                </td>
                @endpermission

                <td class="px-6 py-4">

                    @permission('р.Доски / создавать приглашения')
                    <livewire:board.invitations-form
                        :board_id="$board->id" :show_select_board_id="false"
                        key="{{ $board->id }}"/>
                    @endpermission

                    <livewire:board.invitations-list
                        :board_id="$board->id"
                        {{--                        :show_select_board_id="false"--}}
                        key="invites{{ $board->id }}"
                    />

                    <livewire:board.add-user-form :key="'board'.$board->id" :board_id="$board->id"/>

                    <div class=" max-h-[150px]
                            overflow-auto">
                        @foreach($board->boardUsers as $k => $bu)
{{--                            <pre>{{ print_r($bu->toArray()) }}</pre>--}}
                            <div
                                wire:key="board{{$board->id}}User{{ $bu->id }}"
                                class="

{{--                            inline-block --}}
@if( !empty($bu->deleted) ) bg-red-100 @else bg-green-100 @endif

{{--                            rounded-full--}}
                            px-3 py-1 text-sm
                            font-semibold text-gray-700
                            mb-1
                            ">
                            <span class="@if( !empty($bu->deleted) ) line-through @endif">
                                {{ $bu->user->name }}
                                <sup>
                                    {{ $bu->role->name_ru ?? $bu->role->name }}
                                </sup>
                            </span>

                                @if( !empty($bu->deleted) )
                                    <button class="bg-green-100 hover:bg-green-400 p-1 rounded"
                                            wire:click="onBoardUser({{$bu->id}})">вкл
                                    </button>
                                @else
                                    <button class="bg-red-100 hover:bg-red-400 p-1 rounded"
                                            wire:click="offBoardUser({{$bu->id}})">выкл
                                    </button>
                                @endif
                                {{$bu->id}}
                            </div>
                            {{--                            <pre class="text-xs">{{ print_r($bu->toArray()) }}</pre>--}}

                        @endforeach
                    </div>
                </td>
                @permission('р.Доски / доп.инфа')
                <td class="px-6 py-4">
                    @if($board->created_at)
                        {{ $board->created_at->format('Y-m-d') }}
                        <sup>{{ $board->created_at->format('H:i') }}</sup>
                    @else
                        <span>Дата не указана</span>
                    @endif
                </td>
                @endpermission
                <td class="px-6 py-4">
                    @permission('р.Доски / удалить')
                    <button
                        wire:confirm="Удалить ?"
                        wire:click="delete({{ $board->id }})"
                        class="
{{--                        bg-red-500 hover:bg-red-700 --}}
                        text-red-300
                        hover:text-red-500
                        hover:underline
                        font-bold py-2 px-4 rounded"
                    >
                        X
                    </button>
                    @endpermission

                    @permission('р.Лиды / доска конфиг')
                    <a href="{{ route('board.config',['board'=>$board->id ]) }}"
                       class="hover:text-gray-600 text-white"
                       title="конфиг доски"
                       wire:navigate
                    >⚙️</a>
                    @endpermission


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $boards->links() }}

</div>
