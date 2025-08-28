<span>
{{--    <a href="#" wire:click="openModal" class="text-blue-500 hover:underline">передать лида</a>--}}
    {{--        <pre class="text-xs">{{ print_r($move_variants->toArray(),true) }}</pre>--}}

    <a
        title="Передать лида"
        href="#" wire:click.prevent="openModal" class="text-blue-500 hover:underline"><img src="/icon/arrow-right.png"
                                                                                           class="w-[28px]"/></a>

        @if( $isOpen )

        <div
            {{--        x-data="{ isOpen: @entangle('isOpen') }" x-show="isOpen"--}}
            class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-screen bg-black bg-opacity-50"
{{--            wire:click="closeModal"--}}
        >

                <div class="bg-white rounded shadow-md p-4 w-2/3 justify-center items-center">

                    <span
                        class="float-right cursor-pointer"
                        wire:click="closeModal"
                    >X</span>

                {{--<pre class="text-xs">{{ print_r($move_variants->toArray(),true) }}</pre>--}}

                    @if( $autor_look && count($move_variants->toArray()) > 1 )

                        <form wire:submit.prevent="submit" class="w-full justify-center items-center">
                <h2 class="text-lg font-bold mb-4">Передать лида</h2>
                <div class="my-2">
                    <label for="user" class="block text-sm font-medium text-gray-700">Пользователь</label>
                    <select wire:model="selectedUser" id="user"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                        <option value="">выберите</option>
{{--                        @foreach($users as $user)--}}
                        @foreach($move_variants as $m)
                            @if( $m->user_id != Auth::user()->id )
                                <option
                                    value="{{ $m->user_id }}">
                                {{ $m->user->name }}
                                    {{ $m->user->phone_number ?? '-' }}
                                    {{--                                <pre>{{ $m->user_id }}</pre>--}}
                                    {{--                                ({{ $m->role->name ?? '' }})--}}
                            </option>
                            @endif
                        @endforeach
                    </select>
{{--                    <pre>{{ print_r($users->toArray()) }}</pre>--}}
                </div>
                <div class="text-right">
                    <button type="button" wire:click="closeModal"
                            class="px-2 py-1 xfont-bold xtext-white bg-gray-200 rounded hover:bg-red-700">Отмена
                    </button>
                    <button type="submit" class="px-2 py-1 xfont-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Передать
                    </button>
                </div>
            </form>

                    @endif


        <div class="bg-white rounded shadow-md p-4 w-full"
             x-data="{ showLoading: false }"
        >
            <form wire:submit.prevent="leedMove"
                  @submit="showLoading = true"
            >
                <span class="text-lg font-bold mb-4 ">Текущий лид</span>
                в столбец:
                    <select class="inline-block"
                            wire:model="move_to_column"
                            required>
                        <option value="">выберите</option>
                        @foreach($columns as $column)
                            @if( $column->id != $leed->leed_column_id )
                                <option value="{{ $column->id }}">{{ $column->name }}</option>
                            @endif
                        @endforeach
                    </select>
                <span>
                    <button
                        @click="showLoading = true; "
                        class=" bg-blue-400 rounded px-2 py-1">Переместить</button>
                </span>

              <span x-show="showLoading" class="bg-green-200 p-2 rounded m-2">
                    Перемещаю...
                </span>

                @if(session('moveToColumnMessage'))
                    <span class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('moveToColumnMessage') }}
                    </span>
                @endif

            </form>
        </div>
    </div>
    @endif

</span>
