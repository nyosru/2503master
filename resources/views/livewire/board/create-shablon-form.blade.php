<div>

    <div class="grid grid-cols-3">
        @foreach ($shablons as $k => $shablon)

            {{--            <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($shablon->toArray()) }}</pre>--}}


            @if( $shablon->columns && count($shablon->columns) > 0 )
                <div
                    x-data="{ showForm: false, }"
                    class="bg-gradient-to-br from-orange-200 to-blue-200
                    m-1"
                >

                    <div class="text-lg font-bold">
                        {{ $shablon->name ?? '--' }}
                    </div>
                    <center>
                        <button
                            @click="showForm = !showForm"
                            {{--                        wire:click="createBoardFromShablon({{ $shablon->id }})"--}}
                            {{--                        wire:confirm="Создать доску ?"--}}
                            class="bg-gradient-to-br from-orange-300 to-orange-400 rounded-lg px-2 py-0
                        w-1/2
                        btn btn-sm btn-outline-primary">
                            Создать
                        </button>
                    </center>

                    <livewire:board.template.create-board-from-template-form template_id="{{ $shablon->id }}" />

                    <!-- Форма будет отображаться, когда showForm = true -->
                    <div x-show="showForm" class="m-4 p-4 bg-white border rounded-md shadow">


                        <form wire:submit="createBoardFromShablon({{ $shablon->id }})">
                            <h2 class="text-lg font-bold">Создание доски по шаблону</h2>

                            <input
                                {{--                            x-model="newBoardName"--}}
                                type="text"
                                placeholder="Введите название новой доски"
                                class="border rounded px-2 py-1 w-full mb-2"
                            />

                            <div class="flex space-x-2">

                                <button
                                    type="submit"
                                    {{--                                @click="submitNewBoard({{ $shablon->id }})"--}}
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                                >
                                    Создать
                                </button>

                                {{--                            <button--}}
                                {{--                                @click="showForm = false"--}}
                                {{--                                class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400"--}}
                                {{--                            >--}}
                                {{--                                Отмена--}}
                                {{--                            </button>--}}
                            </div>
                        </form>
                    </div>

                    <div class="pl-2">
                        <b>Шаги проекта:</b>
                        <ul class="pl-10 list-disc">
                            @foreach( $shablon->columns as $step)
                                <li>
                                    {{ $step->name ?? 'x' }}
                                    <span class="rounded-md bg-gray-200 px-2 py-1 rounded">{{ $step->sorting ?? 'x' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if( $shablon->positions && count($shablon->positions) > 0 )
                        <div class="pl-2">
                            <b>Должности:</b>
                            <ul class="pl-10 list-disc">
                                @foreach( $shablon->positions as $p)
                                    <li>{{ $p->name ?? '-'}}</li>
                                @endforeach
                                    <li>Тех.поддержка</li>
                            </ul>
                        </div>
                    @endif

                </div>
            @endif
        @endforeach
    </div>
</div>
