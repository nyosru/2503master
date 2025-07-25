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

        <livewire:board.invitations-list
            :only_for_now_user="true"
            key="invitesboards"
        />

        <livewire:board.create-form return_route="leed.list"/>

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

{{--            <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($boards->toArray()) }}</pre>--}}

            @foreach ($boards as $index => $board)

                <div class="flex items-center py-5 border-b border-gray-200 hover:bg-white
             {{ $index % 2 != 0 ? 'bg-gray-200' : '' }}
            ">
                    <div class="
                 flex-1 pl-2">
                        <div class="text-lg font-bold">
                            {{ $board->name }}
                        </div>

                        <div class="ml-5">
                            @if(!empty($board->boardUsers) )
                                @foreach($board->boardUsers as $ba )
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
                                        {{$ba['role']['name']}}
                                    </a>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="w-1/4 text-left">

                        @if( $domain_in_user_count > 1 )
                            <livewire:board.domain-link-form :board_id="$board->id"
                                                             :key="$board->id.'board_link_domain'"/>
                        @endif

                        @permission('р.Доски / создавать приглашения')
                        <h2 class="font-bold">Приглашения:</h2>
                        <div class="ml-4">

                            <livewire:board.invitations-form
                                :board_id="$board->id" :show_select_board_id="false"
                                key="{{ $board->id }}"/>

                            @foreach( $board->invitations as $i )
                                {{$i->phone}} > {{ $i->role->name }}<br/>
                            @endforeach

                        </div>
                        @endpermission
                    </div>
                    <div class="w-1/4 text-center">

                        @permission('р.Доски / удалить')
                        <a
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
        @endif
    </div>
</div>
