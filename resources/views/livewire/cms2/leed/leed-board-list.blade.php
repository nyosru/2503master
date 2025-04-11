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
        <div class="flex items-center py-2 border-b border-gray-200 font-bold bg-gray-200">
            <div class="flex-1 pl-2">
                Доска
            </div>
            <div class="w-1/4 text-center">
                Ячейка 1
            </div>
            <div class="w-1/4 text-center">
                Ячейка 2
            </div>
            <div class="w-1/4 text-center">
                Ячейка 3
            </div>
        </div>
        @foreach ($boards as $index => $board)
            <div class="flex items-center py-2 border-b border-gray-200 hover:bg-white
             {{ $index % 2 != 0 ? 'bg-gray-200' : '' }}
            ">
                <div class="flex-1 pl-2">
{{--                    <a href="{{ route('leed',['board_id'=>$board->id]) }}"--}}
{{--                       class="text-blue-700 hover:underline"--}}
{{--                    >--}}
                        {{ $board->name }}
{{--                    </a>--}}
{{--                    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($board->toArray()) }}</pre>--}}
                </div>
                <div class="w-1/4 text-center">
                    @if(!empty($board->boardUsers) )
                        @foreach($board->boardUsers as $ba )
{{--                        {{$board->boardUsers[0]['role']['name']}}--}}
                        {{$ba['role']['name']}}
                            <a href="{{ route('leed.goto',[
                                'board_id'=>$board->id,
                                'role_id'=>$ba->role->id
                                ]) }}"
                               class="text-blue-700 hover:underline"
                            >войти</a>
                        <Br/>
                        @endforeach
                    @endif
{{--                  Ячейка 1--}}

                </div>
                <div class="w-1/4 text-center">
{{--                    Ячейка 2--}}
                    -
                </div>
                <div class="w-1/4 text-center">
{{--                    Ячейка 3--}}
                    -
                </div>
            </div>
        @endforeach
    </div>
</div>
