<div>
    <div class="p-2 text-lg border-b">

        <button wire:click="showCreateForm"
                class=" float-right
                    w-[40px]
                    {{--                mb-4 --}}
                    {{--                px-2--}}
                    {{--                py-1--}}
                    {{--                bg-blue-600 --}}
                    mt-[-2px]
                    text-blue-500
                    text-[36px]
                    font-bold
                    {{--                rounded--}}
                    "
                title="Добавить оповещение">+
        </button>

        <span class="font-bold flex items-center">
            <svg class="h-6 w-6 text-red-200 inline"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="13" r="7" />  <polyline points="12 10 12 13 14 13" />  <line x1="7" y1="4" x2="4.25" y2="6" />  <line x1="17" y1="4" x2="19.75" y2="6" /></svg>
            Оповещения</span>


        {{--        @if (session()->has('messageItemInfo'))--}}
        {{--            <span--}}
        {{--                x-data="{ show: true }"--}}
        {{--                x-init="setTimeout(() => show = false, 3000)"--}}
        {{--                x-show="show"--}}
        {{--                x-transition--}}
        {{--                title="{{ session('messageItemInfo') }}" class="bg-green-300 p-1">--}}
        {{--                {{ session('messageItemInfo') }}--}}
        {{--            </span>--}}
        {{--        @endif--}}

        @if (session()->has('message'))
            <div class="bg-green-200 p-2 mb-4 rounded"
                 x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 3000)"
                 x-show="show"
                 x-transition
            >
                {{ session('message') }}
            </div>
        @endif


    </div>

    {{--добаввить оповещение--}}
    @if($showForm)
        <div class="mb-6 p-4 border rounded bg-gray-50" x-data="{ notificationType: '' }">
            <form wire:submit.prevent="saveNotification">
                <div class="mb-2">
                    <label>Текст оповещения</label>
                    <textarea wire:model.defer="message" class="w-full border rounded p-2" required></textarea>
                    @error('message') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label>Тип оповещения</label>
                    <select
                        x-model="notificationType"
                        class="w-full border rounded p-2 mb-4"
                        required
                    >
                        <option value="">Выберите тип</option>
                        <option value="once">Одноразовое</option>
                        <option value="weekly">Еженедельное</option>
                        <option value="monthly">Ежемесячное</option>
                        <option value="yearly">Ежегодное</option>
                    </select>
                </div>

                <!-- Одноразовое оповещение -->
                <div x-show="notificationType === 'once'" class="mb-4 border p-2 rounded">
                    <label class="block font-medium mb-1">Дата и время</label>
                    <input
                        type="datetime-local"
                        wire:model.defer="once_at"
                        class="border rounded p-1 w-full"
                    />
                    @error('once_at') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Еженедельное оповещение -->
                <div x-show="notificationType === 'weekly'" class="mb-4 border p-2 rounded">
                    <div class="mb-2">
                        <label class="block font-medium mb-1">День недели</label>
                        <select
                            wire:model.defer="weekly_day"
                            class="border rounded p-1 w-full"
                        >
                            <option value="">Выберите день недели</option>
                            @foreach(['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'] as $index => $day)
                                <option value="{{ $index }}">{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('weekly_day') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Время</label>
                        <input
                            type="time"
                            wire:model.defer="weekly_time"
                            class="border rounded p-1 w-full"
                        />
                        @error('weekly_time') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Ежемесячное оповещение -->
                <div x-show="notificationType === 'monthly'" class="mb-4 border p-2 rounded">
                    <div class="mb-2">
                        <label class="block font-medium mb-1">День месяца</label>
                        <input
                            type="number"
                            min="1"
                            max="31"
                            wire:model.defer="monthly_day"
                            placeholder="День месяца"
                            class="border rounded p-1 w-full"
                        />
                        @error('monthly_day') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Время</label>
                        <input
                            type="time"
                            wire:model.defer="monthly_time"
                            class="border rounded p-1 w-full"
                        />
                        @error('monthly_time') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Ежегодное оповещение -->
                <div x-show="notificationType === 'yearly'" class="mb-4 border p-2 rounded">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">День</label>
                            <input
                                type="number"
                                min="1"
                                max="31"
                                wire:model.defer="yearly_day"
                                placeholder="День"
                                class="border rounded p-1 w-full"
                            />
                            @error('yearly_day') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block font-medium mb-1">Месяц</label>
                            <input
                                type="number"
                                min="1"
                                max="12"
                                wire:model.defer="yearly_month"
                                placeholder="Месяц"
                                class="border rounded p-1 w-full"
                            />
                            @error('yearly_month') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="block font-medium mb-1">Время</label>
                        <input
                            type="time"
                            wire:model.defer="yearly_time"
                            class="border rounded p-1 w-full"
                        />
                        @error('yearly_time') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <label>Кому отправить (Пользователь)</label>
                    <select wire:model.defer="user_id" class="border rounded p-1 w-full">
                        <option value="">Не выбран</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Сохранить</button>
                    <button type="button" wire:click="$set('showForm', false)" class="bg-gray-400 px-4 py-2 rounded">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Остальная часть шаблона без изменений -->
    {{--    <hr class="my-4"/>--}}
    {{--    <h3 class="text-lg font-semibold mb-2">Список оповещений</h3>--}}
    @if($notifications->isEmpty())
        <p>Оповещений пока нет.</p>
    @else
        {{--        <ul>--}}
        <div class="flex flex-col">
            @foreach($notifications as $notification)
                {{--                <li class="mb-2 border p-2 rounded--}}
                {{--                flex justify-between items-center --}}
                {{--                w-full">--}}
                <div class="p-2">
                    {{--                    <div>--}}
                    <div class="text-gray-600 text-xs">
                        @if($notification->once_at)
                            Одноразовое
                        @elseif(!is_null($notification->weekly_day))
                            Еженедельное
                        @elseif(!is_null($notification->monthly_day))
                            Ежемесячное
                        @elseif(!is_null($notification->yearly_day))
                            Ежегодное
                        @endif

                        <span class="float-right">
                                <button
                                    wire:click="editNotification({{ $notification->id }})"
                                    class="text-blue-600 p-1
                                    hover:bg-blue-200
                                    "
                                >
                                    Изм.
                                </button>
                                <button wire:click="deleteNotification({{ $notification->id }})"
                                        wire:confirm="Удалить оповещение?"
                                        class="text-red-600 p-1
                                          hover:bg-red-200
                                          ">
                                    X
                                    {{--                            Удалить--}}
                                </button>
                            </span>

                    </div>

                    <strong>{{ $notification->message }}</strong><br/>
                    <small>
                        @if($notification->once_at)
                            {{--                                Одноразовое: --}}
                            {{ \Carbon\Carbon::parse($notification->once_at)->format('d.m.Y H:i') }}
                        @elseif(!is_null($notification->weekly_day))
                            {{--                                Еженедельное: --}}
                            {{ ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'][$notification->weekly_day] ?? $notification->weekly_day }}
                            , {{ $notification->weekly_time }}
                        @elseif(!is_null($notification->monthly_day))
                            {{--                                Ежемесячное: --}}
                            {{ $notification->monthly_day }} число, {{ $notification->monthly_time }}
                        @elseif(!is_null($notification->yearly_day))
                            {{--                                Ежегодное: --}}
                            {{ $notification->yearly_day }}.{{ $notification->yearly_month }}
                            , {{ $notification->yearly_time }}
                        @endif
                    </small>
                    {{--                    </div>--}}
                    {{--                    <div class="flex gap-2">--}}

                    {{--                    </div>--}}
                    {{--                </li>--}}
                </div>
            @endforeach
            {{--        </ul>--}}
        </div>
    @endif
</div>
