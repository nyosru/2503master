<div>
    <div class="flex flex-row flex-wrap">
        @foreach ($shablons as $k => $shablon)

            @if( $shablon->columns && count($shablon->columns) > 0 )
                <div
                    class="bg-gradient-to-br from-orange-200 to-blue-200
                    w-full sm:w-1/2 lg:w-1/3 xl:w-1/4
                    p-2 rounded"
                >

                    <div class="text-lg font-bold">
                        {{ $shablon->name ?? '--' }}
                    </div>

                    <livewire:board.template.create-board-from-template-form template_id="{{ $shablon->id }}"/>

                    <div x-data="{ showInfo: false,}">

                        <center>
                            <button
                                @click="showInfo = !showInfo"
                                class="bg-gradient-to-br from-gray-100 to-orange-300 rounded-lg
                                    mt-3 px-2 py-0
                                    w-1/2
                                    btn btn-sm btn-outline-primary">
                                Описание
                            </button>
                        </center>

                        <div x-show="showInfo" class="m-4 p-4 bg-white border rounded-md shadow">

                            <div class="pl-2">
                                <b>Шаги проекта:</b>
                                <ul class="pl-10 list-disc">
                                    @foreach( $shablon->columns as $step)
                                        <li>
                                            {{ $step->name ?? 'x' }}
                                            <span
                                                class="rounded-md bg-gray-200 px-2 py-1 rounded">{{ $step->sorting ?? 'x' }}</span>
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
                    </div>

                </div>

            @endif
        @endforeach
    </div>
</div>
