<div x-data="{ show_form: true }"
     class="p-2 bg-gray-200"
>
{{--<div x-data="{ show_form: false, show_dop_komu: false }" >--}}

{{--    <button type="button" x-show="!show_form" @click="show_form = true" class="text-blue-500 hover:underline mb-4">--}}
{{--        Добавить задачу--}}
{{--    </button>--}}

    <form wire:submit.prevent="add">
        <div class="flex flex-col space-y-2"
             x-show="show_form"
        >
{{--            <div class="text-center texl-lg font-bold">Добавить задачу</div>--}}
            <div class="">
                <label for="text" class="block text-sm font-medium text-gray-400">Описание задачи</label>
                <textarea id="text" wire:model="text"
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
                @error('text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-row">
                <div class="w-[200px]">
                    <label for="notificateDate" class="block text-sm font-medium text-gray-700">
                       <span class="text-gray-400"> Дата время напоминания</span>
                        <input type="datetime-local" id="notificateDateTime" wire:model="notificateDateTime"
                               class="mt-1 block w-full rounded border-gray-300 shadow-sm text-sm">
                    </label>
                </div>
                <div class="flex-1">

{{--                    <div x-show="!show_dop_komu" class="text-right">--}}
{{--                        <button type="button" @click="show_dop_komu = true" class="text-blue-500 hover:underline mb-4">--}}
{{--                            + адресат--}}
{{--                        </button>--}}
{{--                    </div>--}}

                    <div >
                        <label class="block text-sm font-medium text-gray-700">
                            <span class="text-gray-400">                            Адресат:</span>

{{--                            <pre class="text-xs">{{ print_r($users->toArray()) }}</pre>--}}
{{--                            <pre class="text-xs">{{ print_r($u->user->roles->toArray()) }}</pre>--}}

                            <select wire:model="user_worker_id"
                                    class="mt-1 block w-full rounded border-gray-300 shadow-sm text-sm">
                                <option value="">выберите</option>
                                @foreach( $users as $u )
                                    @if( $u->id != Auth::id() )
                                        <option value="{{ $u['id'] }}">
                                            {{ $u['name'] ?? 'x' }}
                                            ({{ $u->Roles[0]->name ?? ''}})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                    </div>
{{--                    <br/>--}}
{{--                    <div class="max-h-[200px] overflow-auto p-2">--}}
{{--                        users:<br/>--}}
{{--                        <pre>x{{ print_r($users) }}</pre>--}}
{{--                    </div>--}}

                </div>
            </div>

{{--            <div class="flex flex-row">--}}
{{--                <div class="w-1/2">--}}
{{--                    <label for="notificateDate" class="block text-sm font-medium text-gray-700">Дата--}}
{{--                        напоминания</label>--}}
{{--                    <input type="date" id="notificateDate" wire:model="notificateDate"--}}
{{--                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">--}}
{{--                </div>--}}

{{--                <div class="w-1/2">--}}
{{--                    <label for="notificateTime" class="block text-sm font-medium text-gray-700">Время--}}
{{--                        напоминания</label>--}}
{{--                    <input type="time" id="notificateTime" wire:model="notificateTime"--}}
{{--                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">--}}
{{--                </div>--}}
{{--            </div>--}}

            {{--                <div class="mt-4">--}}
            {{--                    <label class="inline-flex items-center">--}}
            {{--                        <input type="checkbox" wire:model="remind_in_telegram"--}}
            {{--                               class="rounded border-gray-300 shadow-sm">--}}
            {{--                        <span class="ml-2 text-sm text-gray-700">Напомнить в Telegram</span>--}}
            {{--                    </label>--}}
            {{--                </div>--}}

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-md">Добавить</button>
            </div>
        </div>
    </form>


</div>
