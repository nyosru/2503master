<div class="rounded p-1 flex flex-col space-y-1"
     x-data="{ show_form_ok: false, show_form_cancel: false }"
>

    {{--    <pre class="text-xs max-h-[200px] overflow-auto border border-blue-200 p-1">{{ print_r($i->toArray()) }}</pre>--}}

    <livewire:cms2.leed.item-order-msg-show :user="$i->user" :at="$i->created_at" :msg="$i->text"/>

    @if( !empty($i->transfers) )
        @foreach( $i->transfers as $t )
            <livewire:cms2.leed.item-order-transfer-show
                :key="'item-order-transfer-show'.$t->id"
                :i="$t"/>
        @endforeach
    @endif

    {{--    показ закрытого результата--}}
    @if( $i->status == 'готово' || $i->status == 'отменена' )

        @if( !empty($i->user_worker_id) )
            <div class="ml-[50px]">
                <livewire:cms2.leed.item-order-msg-show
                    :key="'item-order-msg-show'.$i->id"
                    :user="$i->userWorker"
                    :at="$i->worker_comment_at"
                    :msg="$i->worker_comment"/>
            </div>
        @endif


        <div class="flex flex-row space-x-1">

            <div class="flex flex-col w-[120px] space-y-1">

                @if( $i->status == 'готово')
                    <div class="bg-blue-400 text-white text-center w-full rounded">Завершена</div>
                @elseif($i->status == 'отменена' )
                    <div class="bg-blue-400 text-white text-center w-full rounded">Отменена</div>
                @endif

                @if( !empty($i->close_at) )
                    <div
                        class="bg-blue-400 text-white text-center w-full rounded">{{$i->close_at->format('H:i d.m.y') }}</div>
                @endif

            </div>
            <div class="flex-1">
                @if( !empty($i->close_comment) )
                    <div class="border rounded p-1 border border-blue-500 min-h-[3rem]">
                        {{ $i->close_comment ?? '' }}
                    </div>
                @endif
            </div>
        </div>

    @else

        {{--        ещё нет результата--}}

        {{--если работник--}}
        @if( $user_id == $i->user_worker_id )
            @if( $i->worker_job_status == true )
<div class="ml-[50px]">
                <livewire:cms2.leed.item-order-msg-show :user="$i->userWorker" :at="$i->worker_comment_at"
                                                        :msg="$i->worker_comment"/>
</div>
{{--                <div class="text-right block">--}}
{{--            <span class="bg-yellow-200 px-2 p-1 rounded">--}}
{{--                сообщение о готовности, отправлено--}}
{{--            </span>--}}
{{--                </div>--}}
            @else

                @if (session()->has('msgLeedOrderWorker'))
                    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                        {{ session('msgLeedOrderWorker') }}
                    </div>
                @endif

                <form wire:submit.prevent="submitWorkerComment({{$i->id}})">
                    <div class="ml-[50px] p-1 flex flex-col space-y-1">

                        <div class="text-center text-gray-500 text-sm">
                            <label>
{{--                                по готовности, добавте комментарий и отправте--}}
                                {{--        комментарий для заказчика--}}
                                <input type="text"
                                       class="w-full rounded px-2 py-1"
                                       wire:model="workerComment"
                                       placeholder="Комментарий о результате"
                                />
                            </label>
                        </div>
                        {{--        кнопки приёма и отказа--}}
                        <div class="text-right">
                            <button type="submit" class="bg-blue-400 py-0 px-2 rounded">Готово</button>
                        </div>
                    </div>
                </form>
                {{--            @endif--}}

            @endif

        @elseif( !empty($i->user_worker_id) ?? $user_id !== $i->user_worker_id )
            <div class="ml-[50px]">
                @if( $i->worker_job_status != true )
                    <div class="border border-gray-400 bg-gray-200 rounded text-center">
                        ждём решения от: {{ $i->userWorker->name ?? '-' }} ({{ $i->userWorker->Roles[0]->name ?? '-' }})
                    </div>
                @else
                    <livewire:cms2.leed.item-order-msg-show :user="$i->userWorker" :at="$i->worker_comment_at"
                                                            :msg="$i->worker_comment"/>
                @endif
            </div>
        @endif

        {{--кнопки результата--}}


        <div
            x-data="{ show_form_ok: false, show_form_cancel: false, show_form_new_alert: false }"
            class="flex flex-col space-y-1">

            <div class="flex flex-row space-x-1 items-center">
                <div class="flex-1 xw-1/4">
                    @if( !empty($i->user_id) && Auth::id() == $i->user_id )
                        <button
                            @click="show_form_cancel=true; show_form_ok=false; show_form_new_alert=false; $nextTick(() => $refs.inputField_cancel.focus())"
                            class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Отменить
                        </button>
                    @endif
                </div>
                <div class="flex-1 xw-1/4">
                    @if( !empty($i->user_id) && Auth::id() == $i->user_id )
                        <button
                            @click="show_form_ok=true; show_form_cancel=false; show_form_new_alert=false; $nextTick(() => $refs.inputField_ok.focus())"
                            class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Завершить
                        </button>
                    @endif
                </div>
                <div class="flex-1 xw-1/4">

                    {{--                    @if( !empty($i->reminder_at) && ( $user_id == $i->user_worker_id && $i->worker_job_status != true ) )--}}
                    @if( !empty($i->reminder_at) && $i->status == 'новая' && $i->worker_job_status != true )
                        <button
                            @click="show_form_new_alert=true; show_form_ok=false; show_form_cancel=false; $nextTick(() => $refs.inputField_new_alert.focus())"
                            class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Перенести
                        </button>
                    @endif
                </div>
                <div class="11w-1/4 w-[140px] ">
                    {{--                    @if( !empty($i->reminder_at) && $i->reminder_at > now() )--}}
                    @if( !empty($i->reminder_at) && $i->reminder_at > now() && $i->status == 'новая' && $i->worker_job_status != true )
                        {{--                    @if( !empty($i->reminder_at) && ( $user_id == $i->user_worker_id && $i->worker_job_status != true ) )--}}
                        <nobr>
                            <div class="border border-blue-400 py-1 px-2 rounded text-xs text-center">
{{--                                <img--}}
{{--                                    src="/icon/bud.png"--}}
{{--                                    class="inline w-[16px] mr-2"/>--}}

                                <svg class="inline mr-1 h-5 w-5 text-orange-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="13" r="7" />  <polyline points="12 10 12 13 14 13" />  <line x1="7" y1="4" x2="4.25" y2="6" />  <line x1="17" y1="4" x2="19.75" y2="6" /></svg>

                                {{ $i->reminder_at->format('H:i d.m.y') }}
                            </div>
                        </nobr>
                    @endif
                </div>
            </div>
            {{--            формочки по кнопкам закрытия--}}
            <div>

                {{--форма ок--}}
                @if( !empty($i->user_id) && Auth::id() == $i->user_id )
                    <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_ok">
                        <form wire:submit="setStatus('готово')">
                            <div class="flex flex-col ">
                                <div class="text-left">
                                    закрываем задачу, новый статус: <span
                                        class="p-1 bg-green-400 rounded">Завершено</span>
                                </div>
                                <div>
                                    <input type="text"
                                           placeholder="Комментарий к закрытию задачи если есть"
                                           x-ref="inputField_ok"
                                           wire:model="msgClose"
                                           class="mt-2 w-full rounded mb-1"/>
                                </div>
                                <div class="text-right">
                                    <button
                                        type="submit"
                                        class="
            bg-blue-400 mb-5 px-2 py-0 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
                                    >
                                        Отправить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                {{--форма cancel--}}
                @if( !empty($i->user_id) && Auth::id() == $i->user_id )
                    <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_cancel">
                        <form wire:submit="setStatus('отменена')">
                            <div class="flex flex-col ">
                                <div class="text-left">
                                    закрываем задачу, новый статус: <span
                                        class="p-1 bg-green-400 rounded">Отменена</span>
                                </div>
                                <div>
                                    <input type="text"
                                           placeholder="Комментарий к закрытию задачи если есть"
                                           x-ref="inputField_ok"
                                           wire:model="msgClose"
                                           class="mt-2 w-full rounded mb-1"/>
                                </div>
                                <div class="text-right">
                                    <button
                                        type="submit"
                                        class="
            bg-blue-400 mb-5 px-2 py-0 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
                                    >
                                        Отправить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                {{--форма new_alert--}}
                @if( !empty($i->reminder_at) )
                    <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_new_alert">
                        <form
                            @submit.prevent="show_form_new_alert = false; submitForm()"
                            wire:submit="setNewAlert()">
                            <div class="flex flex-col ">
                                <div class="w-full flex flex-row space-x-2">

                                    <label for="notificateDate" class="w-1/2 block text-sm font-medium text-gray-700">
                                        Дата время напоминания
                                        <input type="datetime-local" id="notificateDateTime" wire:model="newReminderAt"
                                               class="mt-1 block w-full rounded border-gray-300 shadow-sm text-sm">
                                    </label>
                                    <label for="msg77" class="w-1/2 block text-sm font-medium text-gray-700">
                                        Сообщение
                                        <input type="text" id="msg77" wire:model="msg"
                                               class="mt-1 block w-full rounded border-gray-300 shadow-sm text-sm">
                                    </label>


                                </div>
                                <div class="w-full text-right">
                                    <button
                                        type="submit"
                                        class="
            bg-blue-400 mb-5 px-2 py-0 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
                                    >
                                        Отправить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

        </div>
    @endif



    @permission('разработка')
    <div
        x-data="{ show22: false }"
    >
        <button type="button" @click="show22 = !show22;">инфа</button>

        <pre x-show="show22"
             class="border border-red-500 p-1 text-sm max-h-[200px] overflow-auto">{{ print_r($i->toArray()) }}</pre>
    </div>
    @endpermission

</div>
