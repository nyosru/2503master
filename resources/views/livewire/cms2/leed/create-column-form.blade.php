<span class="bg-white p-2 rounded shadow w-[400px]">
    <form wire:submit.prevent="save" class="flex flex-col space-y-2">

        {{--            нет досок у пользователя--}}
        @if( 1==2 )
        @if( empty($user->board_user) )
            {{--        <pre class="max-h-[200px] overflow-auto font-mono border text-xs p-2 ">{{ print_r($user->toArray()) }}</pre>--}}
            {{--        -----}}
            {{--        <pre class="max-h-[200px] overflow-auto font-mono border text-xs p-2 ">{{ var_dump($board_id) }}</pre>--}}

            <div>

                <div class="font-bold">
                    Название для рабочей доски <span class="text-gray-500">(область содержащая, все этапы работы)</span>
                </div>

                <div>
                    <input type="text" class="w-full" wire:model="board_name" placeholder="Название рабочей доски">
{{--                    @error('board_name') <span class="error">{{ $message }}</span> @enderror--}}
                </div>

            </div>


            {{--        @elseif( count($user->board_user) > 0)--}}
            {{--                > 0--}}
            {{--            $user->board_user->count(): {{ count($user->board_user)}}--}}
            {{--        @else--}}
            {{--                else >0--}}
            {{--            $user->board_user->count(): {{count($user->board_user)}}--}}
        @endif
        @endif

        <div class="font-bold">
            Cоздать первый столбец <span class="text-gray-500">(этап работы)</span>
        </div>

        <div>
            <input type="text" class="w-full" wire:model="name" placeholder="Название столбца">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-400 px-2 py-1 rounded">Создать</button>
        </div>

    </form>
</span>
