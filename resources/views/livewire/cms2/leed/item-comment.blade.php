<div>
    {{--    item-comment--}}
    {{--    <br/>--}}

{{--        <pre class="text-sx max-h-[200px] overflow-auto">{{ print_r($this->comments->toArray()) }}</pre>--}}

    <div class="flex flex-row">
        <div>
            <button wire:click="changeShowFomrAdd" class="p-2 m-3 rounded bg-blue-300">+ Комментарий</button>
            <button wire:click="changeShowTehComment" class="p-2 m-3 underline text-blue-600">@if($showTehComment)Скрыть@elseПоказать@endif тех. комментарии</button>
        </div>
        <div>

            <!-- Сообщение об успехе -->
            @if (session()->has('commentAddOkMsg'))
                <div class="my-3">
            <span class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('commentAddOkMsg') }}
            </span>
                </div>
            @endif

        </div>
    </div>

    @if( $showFomrAdd )
        {{-- Форма добавления комментария --}}
        <form wire:submit.prevent="addComment" class="mb-4">
            <div class="mb-2">
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea
                    id="comment"
                    wire:model="newComment"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    rows="3"
                    placeholder="Введите комментарий..."
                ></textarea>
                @error('newComment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center">
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600"
                >
                    Добавить комментарий
                </button>
            </div>
        </form>
    @endif

    <div
        style="max-height: 500px; overflow-y: auto;"
    >
        @foreach($comments as $c )
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
                    @formatDate($c->created_at)
{{--                    {{ date('H:i',strtotime($c->created_at)) }}--}}
                    </span>
                {{ $c->comment }}<br/>
            </div>
        @endforeach
    </div>

    {{--    {{$this->comments->links()}}--}}

</div>
