<div>

    leed_record_id: {{ $leed_record_id }}

    {{--    item-comment--}}
    {{--    <br/>--}}

    {{--    <pre>{{ print_r($this->comments) }}</pre>--}}

{{--    <div class="flex flex-row">--}}

{{--        <div>--}}
{{--            <button wire:click="changeShowFomrAdd" class="px-4 py-1 m-2 rounded bg-blue-300">+ задача</button>--}}
{{--        </div>--}}

{{--        <div class="my-3">--}}
{{--            <!-- Сообщение об успехе -->--}}
{{--            @if (session()->has('msgLeedOrder'))--}}

{{--                <span class="bg-green-100 text-green-800 p-2 rounded mb-4">--}}
{{--                {{ session('msgLeedOrder') }}--}}
{{--            </span>--}}

{{--            @endif--}}
{{--        </div>--}}

{{--    </div>--}}

    @if( $showFomrAdd )
        {{-- Форма добавления комментария --}}
        <form wire:submit.prevent="add" class="mb-4 bg-gradient-to-br to-white from-blue-200 p-2">
            <div class="w-full flex flex-row space-x-2">
                <div class="flex flex-col w-1/2">
                    <div class="mb-2">
                        <label
                            {{--                            for="comment" class="block text-sm font-medium text-gray-700"--}}
                        >
                            <div class="bg-blue-300 px-2 py-1 rounded">Задача</div>
                            <textarea
                                id="comment"
                                wire:model="newOrderDesc"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                rows="3"
                                placeholder="Напишите что за задание ..."
                            ></textarea>
                        </label>
                        @error('msgLeedOrder') <span class="text-red-500 text-sm">{{ $msgLeedOrder }}</span> @enderror
                    </div>

                    <div class="text-right">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600"
                        >
                            Добавить
                        </button>
                    </div>

                </div>
                <div class="flex flex-col w-5/12">
                    <div class="bg-blue-300 px-2 py-1 rounded">Напомиинание</div>
                    <div class="p-2">
                        <div class="flex flex-row">
                            <div>
                                <input type="date" wire:model="notificateData"/>
                            </div>
                            <div>
                                <input type="time" wire:model="notificateTime"/>
                            </div>
                        </div>
                        <label>
                            <input type="checkbox" checked wire:model="remind_in_telegram"/> написать в телеграм
                        </label>

                    </div>
                    {{--                    <Br/>--}}
                    {{--                    оповещение на сайте--}}

                </div>
                <div class="
{{--                flex flex-col --}}
                w-1/12 text-right">
                    <button class="text-bold" title="Закрыть" wire:click="changeShowFomrAdd">X</button>
                </div>
            </div>

        </form>
    @endif


{{--    <pre>{{ print_r($notifications->toArray()) }}</pre>--}}

    @if(1==1)
    <div
        style="max-height: 500px; overflow-y: auto;"
    >
        @foreach($notifications as $i )
            {{--        {{ $c->id }}<br/>--}}
            {{--        {{ $c->comment }}<br/>--}}
            {{--        {{ $c->reminder_at }}<br/>--}}
            {{--        {{ $c->autor_id }}<br/>--}}
            {{--        {{ $c->leed_record_id }}<br/>--}}
            {{--        {{ $c->created_at }}<br/>--}}
            {{--        {{ $c->updated_at }}<br/>--}}
            <div class="xmb-1 bg-white hover:bg-gray-200 p-1" style="border-bottom: solid gray 1px;">
                {{--                {{ date('d.m.Y H:i',strtotime($c->added_at)) }}<br/>--}}
                <span class="text-black/50" style="float:right;">
{{--                    {{ date('d.m.Y H:i',strtotime($i->reminder_date) + strtotime($i->reminder_time)) }}--}}
                    {{ $i->reminder_date ?? '' }} {{ $i->reminder_time ?? '' }}
{{--                    {{ date('d.m.Y H:i',strtotime($c->created_at)) }}--}}
                    </span>
                {{ $i->title }}<br/>
            </div>
        @endforeach
    </div>

    {{--    {{$this->comments->links()}}--}}
    @endif
</div>
