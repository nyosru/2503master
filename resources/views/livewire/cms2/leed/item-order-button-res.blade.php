<div
    x-data="{ show_form_ok: false, show_form_cancel: false, show_form_new_alert: false }"
    class="flex flex-col space-y-1">

    <div class="flex flex-row space-x-1 items-center">
        <div class="flex-1 xw-1/4">
            <button
                @click="show_form_cancel=true; show_form_ok=false; show_form_new_alert=false; $nextTick(() => $refs.inputField_cancel.focus())"
                class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Отменить
            </button>
        </div>
        <div class="flex-1 xw-1/4">
            <button
                @click="show_form_ok=true; show_form_cancel=false; show_form_new_alert=false; $nextTick(() => $refs.inputField_ok.focus())"
                class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Завершить
            </button>
        </div>
        <div class="flex-1 xw-1/4">
            <button
                @click="show_form_new_alert=true; show_form_ok=false; show_form_cancel=false; $nextTick(() => $refs.inputField_new_alert.focus())"
                class="rounded bg-blue-400 text-white hover:bg-blue-500 w-full px-1 py-0">Перенести
            </button>
        </div>
        <div class="11w-1/4 w-[140px] ">
            @if( !empty($i->reminder_at) )
                <nobr>
                    <div class="border border-blue-400 py-1 px-2 rounded text-xs text-center"><img src="/icon/bud.png"
                                                                                                   class="inline w-[16px] mr-2"/>{{ $i->reminder_at->format('H:i d.m.y') }}
                    </div>
                </nobr>
            @endif
        </div>
    </div>
    <div>
        {{--<button--}}
        {{--    @click="show_form_cancel=true; show_form_ok=false; $nextTick(() => $refs.inputField_cancel.focus())"--}}
        {{--    class="{{ $i->status === 'отменена' ? 'bg-red-500 text-white' : 'bg-red-100 text-gray-700' }} px-2 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">--}}
        {{--    Отменена--}}
        {{--    </button>--}}


        {{--форма ок--}}
        <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_ok">
            <form wire:submit="setStatus('готово')">
                <div class="flex flex-col ">
                    <div class="text-left">
                        закрываем задачу, новый статус: <span class="p-1 bg-green-400 rounded">Завершено</span>
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
        {{--форма cancel--}}
        <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_cancel">
            <form wire:submit="setStatus('готово')">
                <div class="flex flex-col ">
                    <div class="text-left">
                        закрываем задачу, новый статус: <span class="p-1 bg-green-400 rounded">Отменена</span>
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
        {{--форма new_alert--}}
        <div class="transition-opacity duration-300 ease-in-out" x-show="show_form_new_alert">
            <form wire:submit="setStatus('готово')">
                <div class="flex flex-col ">
                    <div class="text-left">
                        новая дата уведомления
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
    </div>


    {{--    <pre class="text-xs max-h-[200px] overflow-auto">{{ print_r($i->toArray()) }}</pre>--}}

</div>
