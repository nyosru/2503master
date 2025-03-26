<div>

    <div class="p-2 text-lg border-b ">
        <span class="font-bold">Задачи</span>
        {{--кнопки--}}
        <div class="inline float-right text-sm">
            <button
                type="button"
                wire:click="setShowType('all')"
                class="px-2 py-1 hover:bg-blue-200 bg-gray-100 @if($show_type == 'all') border-2 border-blue-400  @endif bg-blue-200">
                Все
            </button>
            <button
                type="button"
                wire:click="setShowType('job')"
                class="px-2 py-1 bg-gray-100 hover:bg-blue-200 @if($show_type == 'job')  border-2 border-blue-400  @endif ">
                В работе
            </button>
            <button
                type="button"
                wire:click="setShowType('finish')"
                class="px-2 py-1 bg-gray-100 hover:bg-blue-200 @if($show_type == 'finish')  border-2 border-blue-400  @endif ">
                Завершённые
            </button>
        </div>
    </div>

    <div class="px-2">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scrollableBlock = document.getElementById('scrollable-block-order');
                scrollableBlock.scrollTop = scrollableBlock.scrollHeight;
            });
        </script>

        @if (session()->has('msgLeedOrder'))
            {{--            <script>--}}
            {{--                document.getElementById('scrollable-block-order').scrollTop = document.getElementById(--}}
            {{--                    'scrollable-block-order').scrollHeight;--}}
            {{--            </script>--}}
            @if(1==2)
                <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('msgLeedOrder') }}
                </div>
            @endif
        @endif

        <div class="h-[535px] overflow-auto flex flex-col space-y-3" id="scrollable-block-order">
            @foreach($items as $i )
                <livewire:cms2.leed.item-order-item :i="$i" :key="'order'.$i->id"/>
            @endforeach
        </div>

    </div>

    <livewire:cms2.leed.item-order-create :leed_record_id="$leed_record_id"/>

</div>
