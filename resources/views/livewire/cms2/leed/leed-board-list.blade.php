<div>

    @if(1==1)
        <div>
            <livewire:Cms2.App.Breadcrumb :menu="[
                                    ['route'=>'leed.list','name'=>'Рабочие доски'],
{{--                                    [--}}
{{--                                        'route'=>'leed',--}}
{{--                                        'route-var'=>['board_id'=>$user->currentBoard->id ?? ''],--}}
{{--                                        'name'=>( $user->currentBoard->name ?? 'x' )--}}
{{--                                    ],--}}
{{--                            ['route'=>'leed','name'=>'Заказы'],--}}
                        ]"/>
        </div>
    @endif

    @if (session()->has('errorNoAccess'))
        <div class="my-4 p-4 bg-red-300 text-lg text-black font-bold rounded">
            {{ session('errorNoAccess') }}
        </div>
    @endif

    <div class="flex flex-col">
{{--123--}}

        {{--            приглашения--}}
        <livewire:board.invitations-list
            :only_for_now_user="true"
{{--            :board_id="$board->id"--}}
            {{--                        :show_select_board_id="false"--}}
{{--            key="invites{{ $board->id }}"--}}
{{--    :only_for_phone=""--}}
            key="invitesboards"
        />

        {{--        <div class="flex items-center py-2 border-b border-gray-200 font-bold bg-gray-200">--}}
        {{--            <div class="flex-1 pl-2">--}}
        {{--                Доска--}}
        {{--            </div>--}}
        {{--            <div class="w-1/4 text-center">--}}
        {{--                Ваша Роль (войти)--}}
        {{--            </div>--}}
        {{--            <div class="w-1/4 text-center">--}}
        {{--                ---}}
        {{--            </div>--}}
        {{--            <div class="w-1/4 text-center">--}}
        {{--                ---}}
        {{--            </div>--}}
        {{--        </div>--}}

        @if( sizeof($boards) == 0 )
            @if(1==2)
                {{-- Здесь отображается ваша форма --}}
                <p class="text-lg font-bold my-2">Добавте свою первую рабочую доску</p>
                <livewire:Board.CreateForm return_route="leed.list"
                                           :show_payes="false"
                                           :show_form="true"
                />
            @endif
        @else

            {{--        <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($boards) }}</pre>--}}

            @foreach ($boards as $index => $board)

                {{--                <br/>--}}
                {{--                <br/>--}}
                {{--        {{$index}} =>--}}
                {{--                <br/>--}}
                {{--                <br/>--}}

                <div class="flex items-center py-5 border-b border-gray-200 hover:bg-white
             {{ $index % 2 != 0 ? 'bg-gray-200' : '' }}
            ">
                    <div class="
                 flex-1 pl-2">
                        <div class="text-lg font-bold">
                            {{--                    <a href="{{ route('leed',['board_id'=>$board->id]) }}"--}}
                            {{--                       class="text-blue-700 hover:underline"--}}
                            {{--                    >--}}
                            {{ $board->name }}
                            {{--                    </a>--}}
                            {{--                            <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($board->toArray()) }}</pre>--}}
                        </div>
                        {{--                <div class="w-1/4 text-center">--}}
                        <div class="ml-5">
                            @if(!empty($board->boardUsers) )
                                @foreach($board->boardUsers as $ba )
                                    {{--                        {{$board->boardUsers[0]['role']['name']}}--}}
                                    <a href="{{ route('leed.goto',[
                                'board_id'=>$board->id,
                                'role_id'=>$ba->role->id
                                ]) }}"
                                       class="text-blue-700
{{--                               hover:underline--}}
                               bg-blue-100
                               hover:bg-blue-200
                               m-2 py-1 px-2
                               border border-bottom-3 border-black
                               rounded"
                                    >
                                        {{$ba['role']['name']}}
                                        {{--                            войти--}}
                                    </a>
                                    {{--                        <Br/>--}}
                                @endforeach
                            @endif
                            {{--                  Ячейка 1--}}

                        </div>
                    </div>
                    <div class="w-1/4 text-left">
                        {{--                    Ячейка 2--}}
                        {{--                        ---}}

                        @permission('р.Доски / создавать приглашения')
                        <h2 class="font-bold">Приглашения:</h2>
                        <div class="ml-4">

                            <livewire:board.invitations-form
                                :board_id="$board->id" :show_select_board_id="false"
                                key="{{ $board->id }}"/>

                            {{--                        <p>Не принятые приглашения:--}}
                            {{--                            <br/>--}}

                            @foreach( $board->invitations as $i )

                                {{--        <pre class="text-left text-xs">{{ print_r($i->toArray()) }}</pre>--}}

                                {{$i->phone}} > {{ $i->role->name }}<br/>

                            @endforeach

                            {{--                        </p>--}}

                        </div>
                        @endpermission
                    </div>
                    <div class="w-1/4 text-center">
                        {{--                    Ячейка 3--}}

                        @permission('р.Доски / удалить')
                        <a
                            {{--                        href="{{ route('board.config.delete',['board'=>$board->id ]) }}"--}}
                            wire:click="delete({{$board->id}})"
                            class="font-bold text-red-500
                       hover:underline
                       cursor-pointer
                       "
                            title="удалить доску"
                            wire:navigate
                            wire:confirm="Удалить доску ?"
                        >X</a>
                        @endpermission
                        @permission('р.Лиды / доска конфиг')
                        <a href="{{ route('board.config',['board'=>$board->id ]) }}"
                           class="hover:text-gray-600 text-white"
                           title="конфиг доски"
                           wire:navigate
                        >⚙️</a>
                        @endpermission

                    </div>
                </div>
            @endforeach
{{--1111--}}
{{--            {{ $this->boards->links() }}--}}

        @endif

    </div>
</div>
