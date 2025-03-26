<div class="flex flex-col space-y-4">

    {{--    <div>1111</div>--}}
    {{--<div>--}}
    {{--    <pre style="max-height: 150px; overflow: auto;" >{{ print_r($columns) }}</pre>--}}
    {{--</div>--}}


    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="flex flex-row space-x-4">
                <div>

                    <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'leed','name'=>'Лиды']]"/>

                </div>
                <div>

                    <!-- Сообщение об успехе -->
                    @if (session()->has('message'))
                        <span class="bg-green-100 text-green-800 p-2 rounded mb-4">
                            {{ session('message') }}
                        </span>
                    @endif

                    <!-- Сообщение об ошибке -->
                    @if (session()->has('error'))
                        <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
                            {{ session('error') }}
                        </span>
                    @endif


                    <!-- Сообщение об успехе -->
                    @if (session()->has('messageAddReasonOtkaz'))
                        <span class="bg-green-100 text-green-800 p-2 rounded mb-4">
                            {{ session('message') }}
                        </span>
                    @endif

                    <!-- Сообщение об ошибке -->
                    @if (session()->has('errorAddReasonOtkaz'))
                        <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
                            {{ session('error') }}
                        </span>
                    @endif



                    {{--                    <input type="text" wire:model.live="searchTerm" placeholder="Поиск по клиенту ..."--}}
                    {{--                           class="form-control">--}}
                    {{--                    @if( $columns && count($columns) > 0 )--}}
                    {{--                        <livewire:Cms2.Leed.AddLeedFormSimple/>--}}
                    {{--                    @endif--}}
                </div>

                <div>

                </div>

            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->


    @if( $columns && count($columns) > 0 )
        {{--        <div class="flex flex-row">--}}
        {{--            <livewire:Cms2.Leed.AddLeedFormSimple/>--}}
        {{--        </div>--}}

        <div class="flex  space-x-1 relative">
            @foreach($columns as $k => $column)
                <div

                    class="
                xw-1/5
                p-1

                relative
                w-[220px]
                bg-gray-100 border rounded relative"

                    id="column-{{ $column->id }}"
                    {{--                ondrop="handleColumnDrop(event, {{ $column->id }})"--}}
                    {{--                ondragover="handleDragOver(event, {{ $column->id }})"--}}

                    ondragover="event.preventDefault()"
                    {{--                            ondrop="event.preventDefault()"--}}
                    ondrop="handleRecordDrop(event, {{ $column->id }})"
                >

                    {{--                заголовок столбца<br/>--}}
                    <div
                        class="flex w-full justify-between items-center mb-2 p-1 sticky top-0 bg-orange-300/70 rounded z-10"
                        id="column-{{ $column->id }}"

                        @if($column->can_move)
                            draggable="true"
                        @endif

                        ondragstart="handleColumnDragStart(event, {{ $column->id }})"
                        ondragover="handleDragOver(event, {{ $column->id }})"
                        ondrop="handleRecordDrop(event, {{ $column->id }})"
                        {{--                     ondrop="handleColumnDrop(event, {{ $column->id }})"--}}
                        {{--                     ondragover="event.preventDefault()"--}}
                        {{--                     ondrop="handleRecordDrop(event, {{ $column->id }})"--}}
                    >
                        <h3 class="font-bold w-full ">

                        <span style="float:right;">

                            @if( $column->can_delete == true && $column->records->isEmpty())
                                <button
                                    class="text-black/50 hover:text-red-600"
                                    wire:click="deleteColumn({{ $column->id }})"
                                    wire:confirm="Вы уверены, что хотите удалить эту колонку?"
                                    title="Удалить колонку"
                                >
                            х
                            </button>
                            @endif



                            {{--                    <livewire:cms2.leed.addColumn :column="$column"/>--}}


                                 @permission('р.Лиды / добавить столбцы')
                            @if( !isset($visibleAddForms[$column->id]) || $visibleAddForms[$column->id] == false )
                                <button
                                    class="text-green-500 hover:text-green-700"
                                    {{--                            wire:click="addColumn({{ $column->id }})"--}}
                                    {{--                                    wire:click="showAddForm({{ $column->id }})"--}}
                                    wire:click="showAddForm({{ $column }})"
                                    title="Добавить новый столбец справа"
                                >
                            +
                            </button>
                            @endif
@endpermission

                                @permission('разработка')
                            <button
                                class="text-blue-500 hover:text-blue-700 focus:outline-none"
                                wire:click="loadColumn({{ $column->id }})"
                            >
                                ⚙️
                            </button>
@endpermission
                        </span>

                            {{ $column->name }}

                            @permission('разработка')
                            <div style="font-weight: normal; line-height: 11px; font-size: 10px;">
                                <br/>
                                id {{$column->id ?? '-' }}
                                userId {{$column->user_id ?? '-' }}
                                Order {{$column->order ?? '-' }}

                                {!! $column->type_otkaz ? '<Br/>Тип Отказник' : '' !!}
                            </div>
                            @endpermission


                        </h3>

                    </div>

                    {{--                форма добавления столюца--}}
                    @permission('р.Лиды / добавить столбцы')
                    @if($visibleAddForms[$column->id] ?? false)

                        <div class="чmy-1 p-1 text-center rounded-xl bg-blue-200">

                            <button class="float-right text-blue-600 text-sm" wire:click="hiddenAddForm()"
                                    title="Скрыть формы">
                                x
                            </button>

                            <b>Добавить столбец справа</b>

                            <form
                                class="block"
                                wire:submit="addColumn({{$column->id }})">
                                <input class="w-full"
                                       wire:model="addColumnName"
                                       type="text" name="addColumnName" value="" placeholder="Название столбца"/>
                                <input
                                    class="bg-blue-200 active:bg-blue-400 rounded px-4 py-2"
                                    type="submit" value="Добавить"/>
                            </form>
                        </div>
                    @endif
                    @endpermission

                    <ul class="space-y-1">

                        {{--                        @if( $column->index == 0 )--}}
                        {{--                        {{ $k ?? 'x' }}--}}

                        @if( $k == 0 )
                            {{--                                    <livewire:cms2.leed.item :i="$record" :key="$record->id" wire:lazy />--}}
                            <li>
                                <livewire:Cms2.Leed.AddLeedFormSimple/>
                            </li>
                        @endif


                        @foreach($column->records as $record)

                            @if( $column->type_otkaz && !empty($record->otkaz_reason) )
                                {{--                                @continue;--}}
                                {{--                            @endif--}}

                            @else
                                <li
                                    class="p-0 m-0"

                                    id="record-{{ $record->id }}"
                                    draggable="true"

                                    ondragstart="handleRecordDragStart(event, {{ $record->id }}, {{ $record->leed_column_id }})"
                                    ondragover="event.preventDefault()"
                                    ondrop="handleRecordDrop(event, {{ $column->id }})"

                                >

                                    @if(1==1)
                                        <div
                                            class="p-2 bg-green-400/30 hover:bg-green-400/50 transition-all border rounded cursor-pointer">


                                            @if(1==1)
                                                @permission('разработка')
                                                <pre
                                                    style="font-size:10px;
                                                max-height: 100px;
                                                overflow: auto;"
                                                >{{ print_r($record->toArray()) }}</pre>
                                                @endpermission
                                            @endif

                                            {{--                            {{ $record->content }}--}}
                                            {{--                            #{{ $record->id }}<br/>--}}

                                            @if( !empty($record->name) )
                                                <a href="{{ route('leed.item',['id'=>$record->id]) }}" wire:navigate
                                                   class="text-blue-600 underline"
                                                >
                                                    <b>
                                                        {{ $record->name }}
                                                    </b>
                                                </a>
                                                <br/>
                                            @endif

                                            @if( !empty($record->phone) )
                                                Тел: {{ $record->phone }}
                                                <br/>
                                            @endif

                                            @if( !empty($record->telegram) )
                                                Tg: {{ $record->telegram }}
                                                <br/>
                                            @endif

                                            @if( !empty($record->whatsapp) )
                                                WA: {{ $record->whatsapp }}
                                                <br/>
                                            @endif

                                            @if( !empty($record->company) )
                                                Компания: {{ $record->company }}
                                                <br/>
                                            @endif

                                            @if( !empty($record->comment) )
                                                комментарий: {{ $record->comment }}
                                                <br/>
                                            @endif

                                            @if($column->type_otkaz == true )

                                                <livewire:cms2.leed.item-otkaz-reason-form :recordId="$record->id"
                                                                                           :key="'rec'.$record->id"/>

                                            @endif

                                        </div>
                                    @endif

                                </li>
                            @endif

                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>


        {{--всплывайка - настройка столбца--}}
        @if ($currentColumnId)
            <!-- Всплывающее окно -->
            <div
                class="
            bg-black/50
            flex items-center justify-center" style="z-index: 100;
            margin: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            ">
                <div class="bg-white
                p-6
                rounded-lg shadow-lg w-1/2 md:w-1/3">
                    <h2 class="text-lg font-bold mb-4">Настройки столбца</h2>
                    <form wire:submit.prevent="saveColumnConfig">

                        <div class="flex flex-col">

                            <div>
                                <pre
                                    style="max-height: 150px; font-size: 10px; overflow: auto;">{{ print_r($column->toArray()) }}</pre>
                            </div>
                            <div class="flex flex-row mb-2">
                                <div>
                                    <label for="canMove" class="block text-sm font-medium text-gray-700 pr-2">
                                        Можно перемещать:
                                    </label>
                                </div>
                                <div>
                                    <input
                                        type="checkbox"
                                        id="canMove"
                                        wire:model="canMove"
                                        xclass="mt-1 block w-[15px] border-gray-300 rounded-md shadow-sm"
                                        @if( $canMove ) checked @endif
                                    />
                                </div>
                            </div>


                            <div class="flex flex-row mb-2">
                                <div>
                                    <label for="canDelete" class="block text-sm font-medium text-gray-700 mr-2">
                                        Можно удалять:
                                    </label>
                                </div>
                                <div>
                                    <input
                                        type="checkbox"
                                        id="canDelete"
                                        wire:model="canDelete"
                                        @if( $canDelete ) checked @endif
                                        xclass="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    />
                                </div>
                            </div>


                            <div class="flex flex-row mb-2">
                                <div>

                                    Тип столбца:
                                </div>
                                <div>
                                    <br/>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Отказники:
                                        &nbsp;
                                        <input
                                            type="checkbox"
                                            wire:model="typeOtkaz"
                                            @if( $typeOtkaz ) checked @endif
                                            xclass="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        />

                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Сообщение об ошибке -->
                        @if (session()->has('error'))
                            <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
                            {{ session('error') }}
                            </span>
                        @endif


                        <div class="text-center mt-4">
                            <button
                                type="button"
                                wire:click="resetForm"
                                class="bg-gray-500 text-white py-1 px-4 rounded mr-2"
                            >
                                Закрыть
                            </button>
                            <button
                                type="submit"
                                class="bg-blue-500 text-white py-1 px-4 rounded"
                            >
                                Сохранить
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endif

    @else
        <div
            class="py-10 w-[60%] mx-auto text-center bg-gradient-to-br from-orange-200 to-red-200 rounded-xl shadow-xl">
            <a href="#" wire:click.prevent="createColumnsForUser"
               class="text-blue-600 underline mr-2">Активировать</a> работу с лидами
        </div>
    @endif









    {{--leed-border перетаскивать лиды--}}
    @if(1==2)
        <script>

            function handleDragStart(event, recordId) {
                event.dataTransfer.setData('recordId', recordId);
            }

            let draggedColumnId = null;
            let draggedRecordId = null;
            let draggedType = '';

            // // Обработка начала перетаскивания колонки
            function handleColumnDragStart(event, columnId) {

                draggedColumnId = columnId;
                draggedType = 'column';

                console.log('handleColumnDragStart 244 ', draggedType, columnId);
// event.dataTransfer.setData('type', 'column');

            }

            // Обработка сброса колонки
            function handleDragOver(event, targetColumnId) {
// let sourceColumnId = event.dataTransfer.getData('columnId');
// console.log( 242, event, targetColumnId);
            }

            // Обработка сброса колонки
            function handleColumnDrop(event, targetColumnId) {

                console.log('handleColumnDrop', event, targetColumnId);

                event.preventDefault();
                const type = event.dataTransfer.getData('type');

                if (type === 'column' && draggedColumnId !== targetColumnId) {
// Вызываем Livewire метод
                @this.call('updateColumnOrder', draggedColumnId, targetColumnId)
                    ;
                    draggedColumnId = null;
                }
            }

            // Обработка начала перетаскивания записи

            function handleRecordDragStart(event, recordId, oldColumnId) {

// console.log('handleRecordDragStart 77 ',recordId,'88',oldColumnId);

                draggedRecordId = recordId;
                draggedType = 'record';
                console.log('handleRecordDragStart 249 ', draggedType, recordId, '88', oldColumnId);

// event.dataTransfer.setData('recordId', recordId);
// event.dataTransfer.setData('oldColumnId', oldColumnId);
            }

            function handleRecordDrop(event, targetColumnId) {

// console.log('handleRecordDrop start 302 ', targetColumnId);

                event.preventDefault();
// const recordId = event.dataTransfer.getData('recordId');

                if (draggedType == 'record') {
                    console.log('handleRecordDrop start 302-1 ', draggedRecordId, targetColumnId);
                    if (draggedRecordId && targetColumnId) {
                        console.log('handleRecordDrop start 302-2 ', draggedRecordId, targetColumnId);
// Вызов Livewire метода
// Livewire.emit('updateRecordColumn', recordId, targetColumnId);
// @this.call('updateColumnOrder', recordId, targetColumnId);
                    @this.call('updateRecordColumn', draggedRecordId, targetColumnId)
                        ;
                        draggedRecordId = '';
                    }
                }

                if (draggedType == 'column') {
                    console.log('handleRecordDrop 88 column ', draggedColumnId, targetColumnId);
                    if (draggedColumnId != targetColumnId) {
                    @this.call('updateColumnOrder', draggedColumnId, targetColumnId)
                        ;
                        draggedColumnId = '';
                    }
                }
            }

            // document.addEventListener('DOMContentLoaded', () => {
            //     const dropzones = document.querySelectorAll('.dropzone');
            //
            //     dropzones.forEach(dropzone => {
            //         // Событие при наведении перетаскиваемого элемента
            //         dropzone.addEventListener('dragover', (event) => {
            //             event.preventDefault();
            //             dropzone.classList.add('highlight');
            //         });
            //
            //         // Событие при выходе из зоны
            //         dropzone.addEventListener('dragleave', () => {
            //             dropzone.classList.remove('highlight');
            //         });
            //
            //         // Событие, когда элемент отпущен над зоной
            //         dropzone.addEventListener('drop', (event) => {
            //             event.preventDefault();
            //             dropzone.classList.remove('highlight');
            //             alert(`Dropped on: ${dropzone.id}`);
            //         });
            //     });
            // });

            // function handleDragOver(event, targetColumnId) {
            //     event.preventDefault();
            //     const target = document.getElementById(`column-${targetColumnId}`);
            //     if (target) {
            //         target.classList.add('highlight');
            //     }
            // }
            //
            // function handleDragLeave(event, targetColumnId) {
            //     const target = document.getElementById(`column-${targetColumnId}`);
            //     if (target) {
            //         target.classList.remove('highlight');
            //     }
            // }

        </script>
    @endif

    @if(1==1)
    <script>
        function initLeedBoardScripts() {
            console.log('Leed-board scripts initialized.');

            // Все функции из вашего скрипта
            window.handleDragStart = function(event, recordId) {
                event.dataTransfer.setData('recordId', recordId);
            };

            let draggedColumnId = null;
            let draggedRecordId = null;
            let draggedType = '';

            window.handleColumnDragStart = function(event, columnId) {
                draggedColumnId = columnId;
                draggedType = 'column';
                console.log('handleColumnDragStart 244 ', draggedType, columnId);
            };

            window.handleDragOver = function(event, targetColumnId) {
                // Логика обработки
            };

            window.handleColumnDrop = function(event, targetColumnId) {
                console.log('handleColumnDrop', event, targetColumnId);

                event.preventDefault();
                const type = event.dataTransfer.getData('type');

                if (type === 'column' && draggedColumnId !== targetColumnId) {
                @this.call('updateColumnOrder', draggedColumnId, targetColumnId)
                    ;
                    draggedColumnId = null;
                }
            };

            window.handleRecordDragStart = function(event, recordId, oldColumnId) {
                draggedRecordId = recordId;
                draggedType = 'record';
                console.log('handleRecordDragStart 249 ', draggedType, recordId, '88', oldColumnId);
            };

            window.handleRecordDrop = function(event, targetColumnId) {
                event.preventDefault();

                if (draggedType === 'record') {
                    console.log('handleRecordDrop start 302-1 ', draggedRecordId, targetColumnId);
                    if (draggedRecordId && targetColumnId) {
                        console.log('handleRecordDrop start 302-2 ', draggedRecordId, targetColumnId);
                    @this.call('updateRecordColumn', draggedRecordId, targetColumnId)
                        ;
                        draggedRecordId = '';
                    }
                }

                if (draggedType === 'column') {
                    console.log('handleRecordDrop 88 column ', draggedColumnId, targetColumnId);
                    if (draggedColumnId !== targetColumnId) {
                    @this.call('updateColumnOrder', draggedColumnId, targetColumnId)
                        ;
                        draggedColumnId = '';
                    }
                }
            };
        }

        // События Livewire
        document.addEventListener('livewire:load', initLeedBoardScripts);
        document.addEventListener('livewire:update', initLeedBoardScripts);
    </script>
   @endif

</div>

