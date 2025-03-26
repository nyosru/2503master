<div class="container mx-auto px-3">
    <div class="overflow-x-auto">
        <!-- Заголовок таблицы -->
        <div class="flex flex-col">
            <div class="flex text-sm font-semibold text-gray-700 bg-gray-200 p-2 border-b border-gray-300">
                <div class="flex-1">Заказ</div>
                <div class="flex-1">Кто</div>
                <div class="flex-1 pr-2 text-end">Сумма</div>
                <div class="flex-1">Дата добавления</div>
            </div>

            <!-- Данные таблицы -->
            <div class="flex flex-col bg-white">
                @if(isset($items) && count($items) === 0)
                    <div class="flex-1 p-2 text-center text-red-600 font-bold">
                        Не найдено данных, поиск: <u>{{ $searchTerm }}</u>
                    </div>
                @else
                    @foreach($items as $i)
                        <div class="flex text-sm border-t border-gray-300 hover:bg-gray-100">
                            <div class="flex-1 p-2">{{ $i->order->name }}</div>
                            <div class="flex-1 p-2">
                                <livewire:cms2.informer.client-basic :i="$i->order->client" :key="$i->id"/>
                            </div>
                            <div class="flex-1 p-2 text-end">
                                {{ number_format($i->order->price, 0, '.', '`') }}
                            </div>
                            <div class="flex-1 p-2">{{ $i->add_ts }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="container mx-auto pt-2">
            {{ $items->onEachSide(2)->links('pagination::tailwind') }}
        </div>

    </div>
</div>
