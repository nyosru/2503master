<div class="p-4 max-w-4xl mx-auto">

    <div>
        <livewire:Cms2.App.Breadcrumb
            {{--            :board_id="$board->id"--}}
            :menu="[
                        ['route'=>'tech.index','name'=>'Тех. отдел'],
                        [ 'route'=>'tech.board.template.manager', 'name'=>'Доски -> Шаблоны', ],
                        ( !empty($nowTemplate)
                            ?
                            [
                                'name' => $nowTemplate->name ,
                                'route'=>'tech.board.template.manager',
                                'route-var'=>[ 'nowTemplate' => $nowTemplate->id ],
                            ]
                            : [] ),
                    ]"/>
        {{--                        'route-var'=>['board'=>$board ?? ''],--}}
        {{--                        'link'=>'no'--}}
    </div>


    @if(!$selectedTemplateId)
        {{-- Список шаблонов досок --}}
        <div>
            <h2 class="text-xl font-bold mb-3">Шаблоны досок</h2>
            <div class="flex flex-row">
                <ul class="mb-4 w-1/2">
                    @foreach($templates as $template)
                        <li
                            {{--                    wire:click="selectTemplate({{ $template->id }})" --}}
                            class="cursor-pointer mb-1 @if($selectedTemplateId == $template->id) font-bold @endif"
                        >
                            <a href="{{ route('tech.board.template.manager', ['selectedTemplateId' => $template->id]) }}"
                               wire:navigate
                               class="p-1 underline hover:bg-orange-300"
                            >
                                {{ $template->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="w-1/2">
                    {{-- Форма создания/редактирования шаблона --}}
                    <input type="text" wire:model.defer="templateName" placeholder="Название шаблона доски"
                           class="border px-2 py-1 mb-2 w-full"/>
                    <button wire:click="saveTemplate" class="bg-blue-600 text-white px-4 py-1 rounded">Сохранить
                        шаблон
                    </button>
                </div>
            </div>
        </div>

    @else
        {{-- Колонки --}}
        {{--        <div class="mt-6">--}}
        {{--            @foreach($templates as $template)--}}
        {{--                @if($selectedTemplateId == $template->id)--}}
        {{--                    Доска: <b>{{ $template->name }}</b>--}}
        {{--                    @break--}}
        {{--                @endif--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
        <div class="flex flex-row flex-wrap
{{--        space-x-5--}}
        ">
            <div class="
{{--        mt-6 --}}
        w-1/2 p-2">
                <livewire:board.template.board-template-columns :template_id="$selectedTemplateId" />
{{--                <h3 class="font-semibold mb-2">Колонки</h3>--}}
{{--                <ul class="mb-2">--}}
{{--                    @foreach ($columns as $column)--}}
{{--                        <li class="flex justify-between items-center mb-1">--}}
{{--                            <span>{{ $column['name'] }}--}}
{{--                            </span>--}}
{{--                            <span>--}}
{{--                            <span class="text-xs rounded-md bg-gray-200 px-2 py-1 rounded" title="сортировка">{{ $column['sorting'] ?? '-' }}</span>--}}
{{--                            <button--}}
{{--                                wire:click="deleteColumn({{ $column['id'] }})"--}}
{{--                                wire:confirm="Удалить?"--}}
{{--                                class="text-red-600 hover:underline">--}}
{{--                                Удалить--}}
{{--                            </button>--}}
{{--                                </span>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--                <input type="text" wire:model.defer="newColumnName" placeholder="Новая колонка"--}}
{{--                       class="border px-2 py-1 mb-2 w-full"/>--}}
{{--                <input type="number" min="1" max="99" step="1" wire:model.defer="sorting"--}}
{{--                       value="50"--}}
{{--                       placeholder="сортировка"--}}
{{--                       class="border px-2 py-1 mb-2 w-[60px]"/>--}}
{{--                <button wire:click="addColumn" class="bg-green-600 text-white px-4 py-1 rounded">Добавить колонку--}}
{{--                </button>--}}
            </div>

            {{-- Должности --}}
            <div class="
{{--        mt-6 --}}
        w-1/2 p-2">
                <h3 class="font-semibold mb-2">Должности</h3>
                <ul class="mb-2">
                    @foreach ($positions as $position)
                        <li class="flex justify-between items-center mb-1">
                            <span>{{ $position['name'] }}</span>
                            <button
                                wire:click="deletePosition({{ $position['id'] }})"
                                wire:confirm="Удалить?"
                                class="text-red-600 hover:underline">Удалить
                            </button>
                        </li>
                    @endforeach
                        <li class="flex justify-between items-center mb-1">
                            <span>Тех.поддержка <sup><abbr title="должность техническая, присваивается автору доски (для настройки и полного технического доступа)" >info</abbr></sup></span>
                        </li>
                </ul>

                <input type="text" wire:model.defer="newPositionName" placeholder="Новая должность"
                       class="border px-2 py-1 mb-2 w-full"/>
                <button wire:click="addPosition" class="bg-green-600 float-right text-white px-4 py-1 rounded">
                    Добавить должность
                </button>

            </div>
            <div class="w-full p-2">
                <livewire:board.template.polya-manager :board_template_id="$selectedTemplateId" />
            </div>
        </div>
    @endif
</div>
