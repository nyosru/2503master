<li

                                    wire:ignore.self
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

            <div class="py-2 text-center">

                <a
{{--                    href="{{ route('leed.item',[ 'board_id'=>$column->board_id , 'id'=>$record->id ]) }}"--}}
                    href="{{ route('board.leed.item',[ 'board_id'=>$column->board_id , 'leed_id'=>$record->id ]) }}"
                   wire:navigate
                   class="text-blue-800 xblock xtext-center hover:underline p-1"
                >

                    @php $hasFields = false; @endphp

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

                {{--блок кнопок менеджер--}}
                <div class="mx-2 mt-1 flex flex-row space-x-1 items-center"
                     wire:key="'column-key-'.$column->id.'-but1-'.$record->id"'"
                >

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

                @if($record->notifications_count > 0)
                    <div
                        title="Есть уведомления в этой записи: {{ $record->notifications_count }}"
                        {{-- style="position:absolute; top:0; right:0;" --}}
                    >
                        <a href="{{ route('leed.item',['board_id'=>$column->board_id ,'id'=>$record->id]) }}"
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
                        :board_id="$record->Column->board_id"
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
            @if( $record->column->can_transfer == true )
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
                        :key="'rec_transfer_'.$record->id"
                    />
                @endif
            @endif
            @endpermission

        </div>

        {{--                                            @permission('р.Лиды / видеть все лиды')--}}
        <div
            class="text-left     @if( !empty($record->user->deleted_at) ) line-through @endif ">

            @if( $user_id != $record->user_id )
                <abbr title="{{$record->user->roles[0]->name ?? '' }}"
                      class="bg-gray-200 p-1 text-sm">{{$record->user->name ?? '-'}}</abbr>
            @endif
        </div>
        {{--                                            @endpermission--}}

    @endif


</li>
