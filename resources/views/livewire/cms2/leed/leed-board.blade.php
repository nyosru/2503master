<div>


    {{--    name {{$user->currentBoard->name ?? 'x' }}<br/>--}}
    {{--    id {{$user->currentBoard->id ?? 'x' }}<br/>--}}

    {{--        <pre class="text-xs">{{ print_R($user->toArray()) }}</pre>--}}
    {{--    <pre class="text-xs">{{ print_R($user->roles[0]['name'],true) }}</pre>--}}

    @if( empty(auth()->user()->phone_number) )

        <div class="block p-3 text-left bg-gradient-to-br from-yellow-200 to-yellow-100
{{--            w-full --}}
            mx-4">
            <h2 class="text-xl font-bold">Для начала работы </h2>
            <br/>
            1) Зайдите в телеграм чат бота <a class="bg-white px-2 py-1 rounded border border-yellow-400"
                                              target="_blank"
                                              href="https://t.me/{{env('TELEGRAM_BOT_USERNAME')}}"><img
                    src="{{asset('/icon/telega/Logo.svg')}}" class="h-6 inline"> {{ env('TELEGRAM_BOT_USERNAME') }}</a>
            <br/>
            2) в боте - поделитесь своим номером телефона (появится кнопка после старта)
            <br/>
            3) в боте - будут приходить оповещения от ПроцессМастер.рф о ваших задачах, напоминаниях и всякое такое
        </div>

        {{--            <pre class="text-xs">{{ print_R(auth()->user()) }}</pre>--}}


        {{--        @if( empty(auth()->user()->phone_number) )--}}
    @else

        <div class="flex flex-col xspace-y-4">
            {{--<div>--}}
            {{--                <pre style="max-height: 150px; overflow: auto;" >{{ print_r($columns) }}</pre>--}}
            {{--</div>--}}

            {{--шапка над доской--}}
            <div class="app-content-header">
                <div class="container">
                    <div class="flex flex-row space-x-4 w-full">
                        @if(1==1)
                            <div class="flex-2">
                                <livewire:Cms2.App.Breadcrumb
                                    :board_id="$board_id"
                                    :menu="[
                                    ['route'=>'leed.list','name'=>'Рабочие доски'],
                                    [
                                        'route'=>'leed',
                                        'route-var'=>['board_id'=>$user->currentBoard->id ?? ''],
                                        'name'=>( $user->currentBoard->name ?? 'x' ).( $user->roles[0]['name'] ? ' <sup>'.$user->roles[0]['name'].'</sup>' : '-' )
                                    ],

{{--                            ['route'=>'leed','name'=>'Заказы'],--}}
                        ]"/>

                            </div>
                        @endif

                        <div class="flex-1">
                            @if(1==2)
                                <form action="{{ route('leed',['board_id'=>$board_id ]) }}"
                                      class="inline"
                                      method="get">

                                    <input type="text" name="search" wire:model="search" class="inline-block
                                @if( !empty($search) ) border border-2 border-red-400 rounded mr-0 @endif
                                "/>@if( !empty($search) )
                                        <a
                                            class="bg-gray-300 p-2 rounded cursor-pointer "
                                            href="{{ route('leed',['board_id'=>$board_id ]) }}"
                                            wire:navigate
                                        >X</a>
                                    @endif

                                </form>
                            @endif


                            <form class="w-full max-w-sm"
                                  method="get"
                                  action="{{ route('leed',['board_id'=>$board_id ]) }}"
                            >
                                <div class="flex items-center
{{--                                border-2 border-b border-red-500--}}
{{--                                rounded--}}
                                p-1
                                ">
                                    <input
                                        placeholder="Поиск"
                                        wire:model="search" name="search"
                                        class="appearance-none
{{--                                        bg-transparent --}}
bg-white
{{--                                        border-none --}}
border-1 rounded
                                        w-full
{{--                                        text-gray-700 --}}
                                        mr-1
                                        py-1 px-2
                                        leading-tight
                                        focus:outline-red-300
                                        "
                                        type="text" placeholder="Jane Doe" aria-label="Full name">
                                    <button
                                        class="flex-shrink-0
{{--                                        ml-[-2px]--}}
                                        bg-blue-400
                                        border-blue-400
                                        hover:bg-blue-500
{{--                                        hover:border-blue-700--}}
                                        text-sm
{{--                                        border-4 --}}
                                        text-white py-1 px-2 rounded"
                                        type="button">
                                        Искать
                                    </button>
                                    @if( !empty($search) )
                                        <a
                                            href="{{ route('leed',['board_id'=>$board_id ]) }}"
                                            wire:navigate
                                            class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded"
                                            type="button">
                                            Отмена
                                        </a>
                                    @endif
                                </div>
                            </form>

                        </div>

                        <div class="flex-1">

<span class="float-right pr-5">
@permission('р.Лиды / доска конфиг')
<a href="{{ route('board.config',['board'=>$board_id ]) }}"
   class="hover:text-gray-600 text-white"
   title="Настройки доски"
>⚙️</a>
@endpermission
</span>

                            <!-- Сообщение об успехе -->
                            @if (session()->has('message'))
                                <span class="bg-green-100 text-green-800 p-2 rounded mb-4">
{{ session('message') }}
</span>
                            @endif

                            @if (session()->has('clientMessage'))
                                <span class="bg-green-100 text-green-800 p-2 rounded mb-4">
{{ session('clientMessage') }}
</span>
                            @endif

                            <!-- Сообщение об ошибке -->
                            @if (session()->has('error'))
                                <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
{{ session('error') }}
</span>
                            @endif

                            @if (session()->has('clientError'))
                                <span class="bg-red-500 text-white inline-block p-2 m-3 rounded ">
{{ session('clientError') }}
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

                        {{--                <div сclass="flex-1 text-right">--}}
                        {{--                    @if(sizeof($user->boardUser) )--}}
                        {{--                        <a href="{{ route('board.select') }}" wire:navigate--}}
                        {{--                           class="text-blue-400 hover:underline"--}}
                        {{--                        >--}}
                        {{--                            выбрать другую доску--}}
                        {{--                        </a>--}}
                        {{--                    @endif--}}
                        {{--                </div>--}}

                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->

            {{--            columns--}}
            {{--                        <pre class="max-h-[100px] text-xs overflow-auto">{{ print_r($columns->toArray())}}</pre>--}}

            @if(1==2)
                <livewire:cms2.leed.select-board-form :user="$user"/>
            @endif

            @if( empty($user->current_board_id) )
                <span class="w-[350px] text-center text-xl font-bold text-gray-400 p-2">Не выбрана рабочая доска</span>
            @else

                @if (session()->has('boardAdded'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded">
                        {{ session('boardAdded') }}
                    </div>
                @endif

                @if( 1==1 )

                    @if( 1 == 1 )

                        @if( $columns->isEmpty() )
                            Добавте первый столбец {{ $board_id ?? 'x' }}
                            <livewire:cms2.leed.create-column-form :user="$user" :board_id="$board_id"
                                                                   type="first"/>
                        @endif

                        <div class="flex  xspace-x-1 relative">
                            @foreach($columns as $k => $column)
                                <div
                                    class="
    p-1
    relative
    w-[250px]
    bg-white border rounded relative"

                                    id="column-{{ $column->id }}"

                                    {{--                    wire:sortable="updateOrder"--}}
                                    {{--                    wire:sortable-group="{{ $column->id }}"--}}

                                    ondragover="event.preventDefault()"
                                    ondrop="handleRecordDrop(event, {{ $column->id }})"

                                    {{--                    wire:sortable="updateColumn"--}}
                                    {{--                    wire:sortable-item="{{ $block->id }}"--}}
                                >

                                    {{--                заголовок столбца<br/>--}}
                                    <div
                                        {{--                        bg-gradient-to-br from-orange-100 to-white--}}
                                        class="flex w-full justify-between items-center
        mb-2 py-1
        sticky top-0
        bg-white
        rounded"
                                        id="column-{{ $column->id }}"

                                        ondragstart="handleColumnDragStart(event, {{ $column->id }})"
                                        ondragover="handleDragOver(event, {{ $column->id }})"
                                        ondrop="handleRecordDrop(event, {{ $column->id }})"

                                        @if($column->can_move)
                                            @permission(
                                    'р.Лиды / двигать столбцы') draggable="true" @endpermission
                                    @endif

                                    >

                                    <h3 class="font-bold w-full text-center pb-1 border-b border-b-gray-200 ">

                                        {{--                            кнопки--}}
                                        <span style="float:right;">

@permission('р.Лиды / удалить столбцы')
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
@endpermission

@permission('р.Лиды / добавить столбцы')
@if( !isset($visibleAddForms[$column->id]) || $visibleAddForms[$column->id] === false )
                                                <button
                                                    class="text-green-500 hover:text-green-700"
                                                    wire:click="showAddForm({{ $column->id }})"
                                                    title="Добавить новый столбец справа"
                                                >
+
</button>
                                            @endif
@endpermission

{{--        @permission('разработка')--}}
@permission('р.Лиды / конфиг столбцов')
<livewire:cms2.leed.column-config :key="$column->id" :column="$column"/>
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
                                                   type="text" name="addColumnName" value=""
                                                   placeholder="Название столбца"/>
                                            <input
                                                class="bg-blue-200 active:bg-blue-400 rounded px-4 py-2"
                                                type="submit" value="Добавить"/>
                                        </form>

                                    </div>
                                @endif
                                @endpermission

                                <ul class="space-y-1">

                                    @if($column->can_create)
                                        @permission('р.Лиды / добавить лида')
                                        <li>
                                            <livewire:Cms2.Leed.AddLeedFormSimple :key="'add'.$column->id"
                                                                                  :column="$column"/>
                                        </li>
                                        @endpermission
                                    @endif


                                    @foreach($column->records as $record)

                                        {{--                                                                <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($record->toArray()) }}</pre>--}}

                                        {{-- инфа о лиде--}}
                                        @if(1==2)
                                            @permission('Полный//доступ')
                                            <div class="bg-yellow-400 p-1">

                                                user: {{ $record->user->id }}/{{ $record->user->name }}
                                                <a href="{{ route('leed.item',['id'=>$record->id]) }}" wire:navigate
                                                   class="text-blue-600 underline block hover:bg-orange-300 p-1"
                                                >
                                                    <b>
                                                        {{ $record->name }}
                                                    </b>
                                                </a>
                                                {{--                                                <br/>--}}


                                                @if( !empty($record->phone) )
                                                    {{--                                                <div class="text-sm">тел</div>--}}
                                                    {{ $record->phone }}
                                                    {{--                                                    <livewire:Informer.PhoneFormatter :phone="$record->phone" :key="'ph'.$record->id"  />--}}
                                                    <br/>
                                                @endif

                                                {{--                                            @if( !empty($record->telegram) )--}}
                                                {{--                                                Tg: {{ $record->telegram }}--}}
                                                {{--                                                <br/>--}}
                                                {{--                                            @endif--}}

                                                {{--                                            @if( !empty($record->whatsapp) )--}}
                                                {{--                                                WA: {{ $record->whatsapp }}--}}
                                                {{--                                                <br/>--}}
                                                {{--                                            @endif--}}

                                                @if( !empty($record->company) )
                                                    {{--                                                    <div class="text-sm">Компания</div>--}}
                                                    <img src="/icon/briefcase.svg" class="w-[18px] mr-1 inline"/>
                                                    {{ $record->company }}
                                                    <br/>
                                                @endif
                                                @if( !empty($record->comment) )
                                                    <div class="text-sm">
                                                        {{--                                                    <div class="text-sm">Компания</div>--}}
                                                        {{ $record->comment }}
                                                    </div>
                                                    {{--                                                <br/>--}}
                                                @endif
                                            </div>
                                            @endpermission
                                        @endif

                                        {{--отказники--}}
                                        @if( $column->type_otkaz && !empty($record->otkaz_reason) )

                                            {{--передать договор подписанный--}}
                                        @elseif( $column->can_transfer && $record->user_id !== Auth::id() && !empty($record->client_id) && !empty($record->order_id) )
                                        @else

                                            {{--                            @if( )--}}
                                            {{--                            <li>{{ $record->user_id }} / {{ Auth::id() }}</li>--}}

                                            <li
                                                {{--                                wire:ignore.self--}}
                                                class="p-1 m-1 border-2 border-gray-500 rounded"
                                                id="record-{{ $record->id }}"

                                                @if($column->can_transfer == true  && isset($record->transfers[0]) && $record->transfers[0]->status == 'новый' )
                                                @else
                                                    draggable="true"
                                                @endif

                                                ondragstart="handleRecordDragStart(event, {{ $record->id }})"
                                                ondragover="event.preventDefault()"
                                                ondrop="handleRecordDrop(event, {{ $column->id }})"
                                            >

                                                @if(1==1)
                                                    <div

                                                        class="xp-2
bg-white/50
{{--               text-center--}}
hover:bg-gray-100
hover:shadow-lg transition-all
{{--border rounded --}}
cursor-pointer relative">

                                                        @if(1==2)
                                                            {{--                                                        блок справа на верху каждого лида--}}
                                                            @iF($record->notifications_count > 0)
                                                                <div
                                                                    style="position:absolute; top:0; right:0;">
                                                                    {{--                                                                {{ $record->notifications_count  }}--}}
                                                                    <svg class="h-8 w-8 text-red-200" width="24"
                                                                         height="24" viewBox="0 0 24 24"
                                                                         stroke-width="2" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                                                        <circle cx="12" cy="13" r="7"/>
                                                                        <polyline points="12 10 12 13 14 13"/>
                                                                        <line x1="7" y1="4" x2="4.25" y2="6"/>
                                                                        <line x1="17" y1="4" x2="19.75" y2="6"/>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        {{--<pre class="overflow-auto max-h-[500px] text-sm">{{ print_r($record->toArray(),true) }}</pre>--}}
                                                        {{--                                                        <pre class="overflow-auto max-h-[500px] text-sm">{{ print_r($column->toArray(),true) }}</pre>--}}

                                                        <div class="py-2 text-center">


                                                            <a href="{{ route('leed.item',[
'board_id'=>$column->board_id ,
'id'=>$record->id
]) }}"
                                                               wire:navigate
                                                               class="text-blue-800 xblock xtext-center hover:underline p-1"
                                                            >
                                                                {{--<pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($record->column->board->fieldSettings->toArray()) }}</pre>--}}
                                                                {{--                                                                <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($record->toArray()) }}</pre>--}}
                                                                {{-- <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($record->column->board->fieldSettings->toArray()) }}</pre>--}}
                                                                @php $hasFields = false; @endphp

                                                                @if( 1==2 )
                                                                    <pre
                                                                        class="text-xs max-h-[200px] overflow-auto">{{ print_r($record->column->board->fieldSettings->toArray()) }}</pre>
                                                                    <br/>
                                                                    $record
                                                                    <br/>
                                                                    <pre
                                                                        class="text-xs max-h-[200px] overflow-auto">{{ print_r($record->toArray()) }}</pre>
                                                                @endif

                                                                @foreach( $record->column->board->fieldSettings as $f )

                                                                    @if( !empty($record->{$f->field_name}) )
                                                                        {{ $record->{$f->field_name} }}
                                                                        <br/>
                                                                        @php $hasFields = true; @endphp
                                                                    @endif

                                                                @endforeach

                                                                @if(!$hasFields)
                                                                    Запись #{{$record->id}}<br/>
                                                                @endif
                                                            </a>


                                                            {{--                                                            строки олд--}}
                                                            @if(1==2)
                                                                @if( !empty($record->name) )
                                                                    <a href="{{ route('leed.item',[
'board_id'=>$column->board_id ,
'id'=>$record->id
]) }}"
                                                                       wire:navigate
                                                                       class="text-blue-400 xblock xtext-center hover:underline p-1"
                                                                    >
                                                                        {{--                                                        @if( !empty($record->phone) )--}}
                                                                        {{--                                                            {{$record->phone ?? '-'}} /--}}
                                                                        {{--                                                        @endif--}}
                                                                        {{ $record->name }}
                                                                    </a>
                                                                @endif
                                                                @if( !empty($record->order->price) )
                                                                    <br/>
                                                                    <span class="text-xl text-red-600 ">
{{--                                                    <svg class="h-4 w-4 text-gray-500 inline " fill="none" viewBox="0 0 24 24"--}}
                                                                        {{--                                                         stroke="currentColor">--}}
                                                                        {{--                                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
                                                                        {{--                                                              stroke-width="2"--}}
                                                                        {{--                                                              d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>--}}
                                                                        {{--                                                    </svg>--}}
                                                                        {{  number_format($record->order->price,0,'',' ') }} руб
</span>
                                                                @elseif( !empty($record->budget) )
                                                                    <br/>
                                                                    <span class="text-xl text-gray-400">
                                {{  number_format($record->budget,0,'',' ') }} руб
                            </span>
                                                                @endif
                                                            @endif

                                                            {{--блок кнопок менеджер--}}
                                                            <div class="
{{--                                            w-[255px]--}}
mx-2

{{--                                            mx-auto--}}
{{--inline--}}
mt-1 flex flex-row space-x-1 items-center">

                                                                @if(1==2)
                                                                    <livewire:cms2.informer.leed.client
                                                                        {{--                                                                    :key="'block-'.$column->id.'-but1-'.$record->id"--}}
                                                                        :key="'but1-'.$record->id"
                                                                        :leed="$record"/>
                                                                @endif
                                                                {{--                                                    <livewire:cms2.informer.leed.order :key="'block-but2-'.$record->id"--}}
                                                                {{--                                                                                       :leed="$record"/>--}}

                                                                {{--твои горящие задачи--}}
                                                                <livewire:cms2.informer.leed.order-you
                                                                    {{--                                                                    :key="'block-'.$column->id.'-but3-'.$record->id"--}}
                                                                    :key="'but3-'.$record->id"
                                                                    :leed="$record"/>
                                                                {{--горящие задачи от других--}}
                                                                <livewire:cms2.informer.leed.order-to-you
                                                                    {{--                                                                    :key="'block-'.$column->id.'-but4-'.$record->id"--}}
                                                                    :key="'but4-'.$record->id"
                                                                    :leed="$record"/>
                                                                {{--кол-во комментариев и горит если есть непрочитанные другие--}}
                                                                <livewire:cms2.informer.leed.comment
                                                                    {{--                                                                    :key="'block-'.$column->id.'-but5-'.$record->id"--}}
                                                                    :key="'but5-'.$record->id"
                                                                    :leed="$record"/>
                                                                {{--передать лида--}}
                                                                {{--                                                            <livewire:cms2.leed.move :leed="$record"/>--}}

                                                                @iF($record->notifications_count > 0)

                                                                    <div
                                                                        title="Есть уведомления в этой записи: {{ $record->notifications_count }}"
                                                                        {{--                                                                        style="position:absolute; top:0; right:0;"--}}
                                                                    >
                                                                        <a href="{{ route('leed.item',[
'board_id'=>$column->board_id ,
'id'=>$record->id
]) }}"
                                                                           wire:navigate
                                                                           class="text-blue-400 xblock xtext-center hover:underline p-1"
                                                                        >
                                                                            {{--                                                                {{ $record->notifications_count  }}--}}
                                                                            <svg class="h-6 w-6 text-red-200" width="24"
                                                                                 height="24" viewBox="0 0 24 24"
                                                                                 stroke-width="2" stroke="currentColor"
                                                                                 fill="none" stroke-linecap="round"
                                                                                 stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z"/>
                                                                                <circle cx="12" cy="13" r="7"/>
                                                                                <polyline points="12 10 12 13 14 13"/>
                                                                                <line x1="7" y1="4" x2="4.25" y2="6"/>
                                                                                <line x1="17" y1="4" x2="19.75" y2="6"/>
                                                                            </svg>
                                                                        </a>
                                                                    </div>

                                                                @endif

                                                            </div>

                                                            {{--                                                            <pre class="text-xs text-left">{{ print_r($column->toArray(),1) }}</pre>--}}

                                                            @if($column->can_get)
                                                                @if( $record->user_id != Auth()->user()->id )
                                                                    <livewire:leed.action-get
                                                                        :leed="$record"
                                                                        :board_id="$board_id"
                                                                        :key="'canget'.$record->id"
                                                                    />
                                                                @endif
                                                            @endif

                                                            @if($column->type_otkaz == true )
                                                                <livewire:cms2.leed.item-otkaz-reason-form
                                                                    :recordId="$record->id"
                                                                    :key="'rec'.$record->id"/>
                                                            @endif

                                                            @permission('р.Лиды / отправить лида с дог-ом')
                                                            @if($column->can_transfer == true )
                                                                @if( empty($record->client_id) || empty($record->order_id) )
                                                                    @if( empty($record->client_id) )
                                                                        <div class="
                                        text-gray-600
                                        bg-gray-200 rounded border-gray-500 border p-1 my-1">
                                                                            Добавте
                                                                            клиента
                                                                        </div>
                                                                    @endif
                                                                    @if( empty($record->order_id) )
                                                                        <div class="
text-gray-600
bg-gray-200 rounded border-gray-500 border p-1 my-1
{{--                                                        bg-yellow-200 p-1 my-1--}}
">Добавте заказ
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <livewire:cms2.leed.item-transfer-form
                                                                        :lead="$record"
                                                                        :key="'rec_transfer_'.$record->id"/>
                                                                @endif
                                                            @endif
                                                            @endpermission

                                                            @if(1==2)
                                                                @permission('разработка')
                                                                <div class="text-sm max-h-[200px] overflow-auto">
                                                                    <pre>{{ print_r($record->toArray(),1) }}</pre>
                                                                </div>
                                                                @endpermission
                                                            @endif

                                                        </div>

                                                        {{--                                            @permission('р.Лиды / видеть все лиды')--}}
                                                        <div
                                                            class="text-left     @if( !empty($record->user->deleted_at) ) line-through @endif ">

                                                            @if( $user_id != $record->user_id )
                                                                <abbr title="{{$record->user->roles[0]->name ?? '' }}"
                                                                      class="bg-gray-200 p-1 text-sm">{{$record->user->name ?? '-'}}</abbr>
                                                            @else
                                                                {{--                                                <span class="bg-green-100 p-1 text-sm">--}}
                                                                {{--                                                   ваш лид--}}
                                                                {{--                                                </span>--}}
                                                            @endif
                                                        </div>
                                                    {{--                                            @endpermission--}}

                                                @endif


                                            </li>
                                        @endif

                                        {{--                            <pre class="text-sm max-h-[200px] overflow-auto">{{print_r($record->toArray())}}</pre>--}}

                                    @endforeach
                                </ul>
                        </div>
                        @endforeach
        </div>

        @else

            <div
                class="py-10 w-[60%] mx-auto text-center bg-gradient-to-br from-orange-200 to-red-200 rounded-xl shadow-xl">
                нет этапов
                {{--        Недостаточно прав доступа для просмотра данного раздела--}}
                {{--            <a href="#" wire:click.prevent="createColumnsForUser"--}}
                {{--               class="text-blue-600 underline mr-2">Активировать</a> работу с лидами--}}
            </div>
        @endif



        {{--<livewire:cms2.leed.create-column-form />--}}

        {{--leed-border перетаскивать лиды--}}
        @if(1==1)
            <script>

                function handleDragStart(event, recordId) {
                    event.dataTransfer.setData('recordId', recordId);
// console.log('handleDragStart 320', recordId);
                }

                var draggedColumnId = null;
                var draggedRecordId = null;
                var draggedType = '';

                // // Обработка начала перетаскивания колонки
                function handleColumnDragStart(event, columnId) {

                    draggedColumnId = columnId;
                    draggedType = 'column';

// console.log('handleColumnDragStart 244 ', draggedType, columnId);
                }

                //             // Обработка сброса колонки
                //             function handleDragOver(event, targetColumnId) {
                // // let sourceColumnId = event.dataTransfer.getData('columnId');
                // console.log( 'handleDragOver 338', event, targetColumnId);
                //             }

                // Обработка сброса колонки
                function handleColumnDrop(event, targetColumnId) {

// console.log('handleColumnDrop', event, targetColumnId);

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

                function handleRecordDragStart(event, recordId) {
                    {{--                console.log('handleRecordDragStart {{ __LINE__ }} ', draggedType, recordId);--}}
                        draggedRecordId = recordId;
                    draggedType = 'record';
                }

                function handleRecordDrop(event, targetColumnId) {

// console.log('handleRecordDrop start 302 ', targetColumnId);

                    event.preventDefault();
// const recordId = event.dataTransfer.getData('recordId');

                    if (draggedType == 'record') {
// console.log('handleRecordDrop 388 тащим рекорд');
                        if (draggedRecordId && targetColumnId) {
// console.log('handleRecordDrop 390 приитащили №запись в №столбец ', draggedRecordId,
//     targetColumnId);
//

                            const moveRecordShow = document.getElementById('move_record_show');
                            moveRecordShow.style.display = 'block';

                        @this.call('updateRecordColumn', draggedRecordId, targetColumnId)
                            ;
                            draggedRecordId = '';

// console.log('handleRecordDrop 390 ОК / приитащили запись в столбец');
                        }
                    }

                    if (draggedType == 'column') {
// console.log('handleRecordDrop 88 column ', draggedColumnId, targetColumnId);
                        if (draggedColumnId != targetColumnId) {
                        @this.call('updateColumnOrder', draggedColumnId, targetColumnId)
                            ;
                            draggedColumnId = '';

                        }
                    }
                }

            </script>
        @endif

        {{--перетаскиваем на livewire--}}
        @if(1==2)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    @foreach($columns as $column => $tasks)
                    new Sortable(document.querySelector('[wire\\:sortable-group="{{ $column }}"]'), {
                        group: 'shared',
                        animation: 150,
                        onEnd: function (evt) {
                            let order = {};

                            document.querySelectorAll('[wire\\:sortable-group]').forEach(el => {
                                order[el.getAttribute('wire:sortable-group')] =
                                    Array.from(el.children).map(item => item.getAttribute('wire:sortable.item'));
                            });

                            Livewire.emit('updateOrder', order);
                        }
                    });
                    @endforeach
                });
            </script>
        @endif

        <div id="move_record_show" style=" display:none; position: fixed; bottom:10px; right: 10px; width: 200px;"
             class="text-center rounded-xl bg-green-200 py-2">Перемещаю<br/>
            <img src="/icon/move.svg" class="mx-auto mt-2" style="height: 30px;" alt="" border="0"/>
        </div>

    @endif

    @endif

</div>

@endif


</div>
