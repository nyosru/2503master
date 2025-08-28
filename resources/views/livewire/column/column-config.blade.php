<div>

    <button
        class="text-blue-500 hover:text-blue-700 focus:outline-none"
        wire:click="openModal({{ $column->id }})"
    >
        ⚙️
    </button>

    @if ($modal_show)
    <div style="isolation: isolate;">
        <div
{{--            class="fixed inset-0 bg-black/50"--}}
        >
            @teleport('body')
            <!-- Всплывающее окно -->
            {{--        <div class="bg-black/50 flex items-center justify-center" style="z-index: 100; margin: 0; position: fixed; top: 0; bottom: 0; left: 0; right: 0;">--}}
            {{--            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 md:w-1/3">--}}
            <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

                <Style>
                    .animated-box {
                        transition: width 2.5s ease, height 2.5s ease;
                        overflow: hidden; /* чтобы не было резких появлений скроллов */
                    }
                </Style>

                <div class="bg-white p-6 rounded-lg shadow-lg

            w-full
            md:w-auto

            max-h-[70vh]
            md:max-h-[90vh]
{{--            overflow-y-auto--}}
{{--              transition-all duration-500 ease-in-out--}}
animated-box
            ">

                    <a type="button" wire:click="$set('modal_show', false)"
                       class="float-right
{{--                   bg-gray-500 --}}
                   px-4 py-1
                        mt-[-26px]
                        mr-[-30px]
                        font-bold
                            cursor-pointer
                            ">
                        X
                    </a>

                    <h2 class="text-lg font-bold mb-4">
                        Настройки столбца: <u>{{ $column->name }}</u>
                    </h2>

                    <div class="flex flex-col md:flex-row">
                        <div class="
                    w-auto md:w-[150px]
                    flex flex-wrap flex-row md:flex-col
                    border-r-[3px] border-orange-200

                    ">

                            @foreach( $menu as $m )
                                <button wire:click="showTplSet('{{ $m['template'] }}')"
                                        class="block
                                    w-auto md:w-full
                                    text-left
                                     @if($m['template'] == $show_tpl )
                                     bg-orange-200
                                     @else
                                     bg-gray-200
                                     @endif
                                    p-2
                                    "
                                >{{ $m['name'] ?? 'x-x-' }}</button>
                            @endforeach
                            {{--<br/>--}}
                            {{--<br/>--}}
                            {{--                            show_tpl:<Br/>--}}
                            {{--                        {{ $show_tpl ?? 'xx' }}--}}

                        </div>

                        <div class="flex-1 bg-white p-2
                    animated-box
                    "
                        >

                            {{--                        $show_tpl: {{$show_tpl??'-'}}--}}
                            {{--                        <br/>--}}
                            {{--                        <br/>--}}

                            @foreach( $menu as $m )
                                @if($show_tpl == $m['template'])
                                    <livewire:dynamic-component
                                        :component="$show_tpl"
                                        :column="$column"
                                        :key="'wev'.$m['template']"/>
                                @endif
                            @endforeach

                        </div>
                    </div>


                    @if(1==2)
                        <br/>
                        <hr>
                        <br/>
                        <hr>
                        <br/>
                        <hr>
                        <br/>
                        <hr>
                        <br/>





                        <h2 class="text-lg font-bold mb-4">

                            Настройки столбца: <u>{{ $column->name }}</u></h2>

                        <form wire:submit.prevent="saveColumnConfig">

                            <div class="flex flex-row
space-x-2
">
                                <div class="w-1/2 flex flex-col space-x-3 text-sm font-medium">

                                    <div class="flex flex-row mb-2 space-x-2">

                                        <div class="w-1/4">
                                            Название:
                                        </div>
                                        <div class="w-3/4">
                                            <input type="text" wire:model="settings.name" class="w-full"/>
                                        </div>
                                    </div>


                                    @foreach ($settings as $key => $value)
                                        <div class="flex flex-row mb-2 space-x-2">
                                            <div class="w-3/4 text-right">
                                                {{ $named[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}:
                                            </div>
                                            <div class="w-1/4">
                                                <input type="checkbox" wire:model="settings.{{ $key }}"
                                                       @if($value) checked @endif />
                                            </div>
                                        </div>
                                    @endforeach


                                    <!-- Сообщение об ошибке -->
                                    @if (session()->has('error'))
                                        <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </span>
                                    @endif

                                    <div class="text-center mt-4">
                                        <button type="button" wire:click="$set('modal_show', false)"
                                                class="bg-gray-500 text-white py-1 px-4 rounded mr-2">
                                            Закрыть
                                        </button>
                                        <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded">
                                            Сохранить
                                        </button>
                                    </div>
                                </div>

                                <div
                                    class="w-1/2 flex flex-col space-x-3 text-sm font-medium
    border-left border-l-2 border-l-red-500
{{--                            pl-2--}}
    ">

                                    <h3 class="p-1 bg-red-100 mb-1 ">Настройки макросов:</h3>

                                    <div class="flex flex-col space-y-2">

                                        <div class="">
                                            {{--                                    <pre--}}
                                            {{--                                        class="max-h-[500px] text-xs--}}
                                            {{--                                        overflow-auto--}}
                                            {{--                                        ">--}}
                                            {{--                                        {{ print_r($macroses->toArray()) }}--}}
                                            {{--                                        {{ print_r($macroses) }}--}}
                                            {{--                                    </pre>--}}
                                            {{--                                    <pre class="max-h-[200px] text-xs overflow-auto">{{ print_r($macroses) }}</pre>--}}
                                            @foreach( $macroses as $mm )
                                                {{--                                        <pre--}}
                                                {{--                                            class="--}}
                                                {{--                                            max-h-[200px] --}}
                                                {{--                                            text-xs--}}
                                                {{--                                            overflow-auto--}}
                                                {{--                                            ">{{ print_r($mm) }}</pre>--}}
                                                <livewire:column.config-macro-item-show :item="$mm"/>
                                            @endforeach
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-lg w-full">
                                            <livewire:column.config-macro-form
                                                :column="$column->id"
                                                type="on_pause_to_move"
                                                board_id="{{ $column->board_id }}"/>
                                        </div>


                                        {{--                                <div class="flex flex-row font-bold bg-black/20">--}}
                                        {{--                                    <div class="w-[30px] text-center">--}}
                                        {{--                                        вкл--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="flex-1">--}}
                                        {{--                                        описание, настройки--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}

                                        <div class="border-l-[10px] border-l-yellow-200">
                                            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                                                <label>
                                                    <input type="checkbox"
                                                           class="p-1 rounded"
                                                        {{--                                           wire:model="settings.{{ $key }}"--}}
                                                        {{--                                           @if($value) checked @endif --}}
                                                    />
                                                    перенос записей если висит без новых комментариев и движений
                                                </label>
                                            </div>
                                            <div class="pl-2
{{--                                    text-center--}}
">
                                                запись находится в столбце дольше
                                                <div class="">
                                                    <input
                                                        class="p-1 rounded w-[60px] bg-transparent"
                                                        type="number"
                                                        min="1"
                                                        max="99"
                                                        step="1"
                                                    />

                                                    <span class="text-sm">дней (включительно)</span>
                                                </div>

                                                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                                                    <option>-- выберите столбец --</option>
                                                </select>.
                                            </div>
                                        </div>


                                        <div class="border-l-[10px] border-l-yellow-200">
                                            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                                                <label>
                                                    <input type="checkbox"
                                                           class="p-1 rounded"
                                                        {{--                                           wire:model="settings.{{ $key }}"--}}
                                                        {{--                                           @if($value) checked @endif --}}
                                                    />
                                                    перенос записей если висит без новых комментариев и движений
                                                </label>
                                            </div>
                                            <div class="pl-2
{{--                                    text-center--}}
">
                                                запись находится в столбце дольше
                                                <div class="">
                                                    <input
                                                        class="p-1 rounded w-[60px] bg-transparent"
                                                        type="number"
                                                        min="1"
                                                        max="99"
                                                        step="1"
                                                    />

                                                    <span class="text-sm">дней (включительно)</span>
                                                </div>

                                                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                                                    <option>-- выберите столбец --</option>
                                                </select>.
                                            </div>
                                        </div>


                                        <div class="border-l-[10px] border-l-yellow-200">
                                            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                                                <label>
                                                    <input type="checkbox"
                                                           class="p-1 rounded"
                                                        {{--                                           wire:model="settings.{{ $key }}"--}}
                                                        {{--                                           @if($value) checked @endif --}}
                                                    />
                                                    перенос записей если висит без новых комментариев и движений
                                                </label>
                                            </div>
                                            <div class="pl-2
{{--                                    text-center--}}
">
                                                запись находится в столбце дольше
                                                <div class="">
                                                    <input
                                                        class="p-1 rounded w-[60px] bg-transparent"
                                                        type="number"
                                                        min="1"
                                                        max="99"
                                                        step="1"
                                                    />

                                                    <span class="text-sm">дней (включительно)</span>
                                                </div>

                                                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                                                    <option>-- выберите столбец --</option>
                                                </select>.
                                            </div>
                                        </div>


                                        <div class="border-l-[10px] border-l-yellow-200">
                                            <div class="
{{--                                    bg-yellow-200 --}}
p-1 rounded font-bold">
                                                <label>
                                                    <input type="checkbox"
                                                           class="p-1 rounded"
                                                        {{--                                           wire:model="settings.{{ $key }}"--}}
                                                        {{--                                           @if($value) checked @endif --}}
                                                    />
                                                    перенос записей если висит без новых комментариев и движений
                                                </label>
                                            </div>
                                            <div class="pl-2
{{--                                    text-center--}}
">
                                                запись находится в столбце дольше
                                                <div class="">
                                                    <input
                                                        class="p-1 rounded w-[60px] bg-transparent"
                                                        type="number"
                                                        min="1"
                                                        max="99"
                                                        step="1"
                                                    />

                                                    <span class="text-sm">дней (включительно)</span>
                                                </div>

                                                перенеси запись в&nbsp;столбец <select class="p-1 rounded">
                                                    <option>-- выберите столбец --</option>
                                                </select>.
                                            </div>
                                        </div>


                                    </div>


                                </div>

                            </div>


                        </form>
                    @endif


                </div>
            </div>
            @endteleport

    </div>
    </div>
    @endif
</div>
