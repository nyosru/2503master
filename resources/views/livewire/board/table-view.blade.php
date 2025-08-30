<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Заголовок и выбор столбца -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Табличное представление</h2>

        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Выбор столбца -->
            <div class="w-full sm:w-64">
                <label class="block text-sm font-medium text-gray-700 mb-1">Столбец:</label>
                <select wire:model.live="selectedColumnId"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @foreach($columns as $column)
                        <option value="{{ $column->id }}">{{ $column->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Поиск -->
            <div class="w-full sm:w-64">
                <label class="block text-sm font-medium text-gray-700 mb-1">Поиск:</label>
                <input type="text" wire:model.live="search"
                       placeholder="Поиск по ID, клиенту..."
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Информация о выбранном столбце -->
    @if($selectedColumn)
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="font-semibold text-blue-800">Текущий столбец: {{ $selectedColumn->name }}</h3>
            <p class="text-sm text-blue-600">
                Записей: {{ $records->total() }}
                @if($selectedColumn->type_otkaz)
                    <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Отказники</span>
                @endif
            </p>
        </div>
    @endif

    <!-- Таблица -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('id')">
                    ID
                    @if($sortField === 'id')
                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                    @endif
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('created_at')">
                    Дата создания
                    @if($sortField === 'created_at')
                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                    @endif
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Клиент
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Менеджер
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Телефон
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Действия
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($records as $record)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900">
                        <a href="{{ route('leed.item', ['board_id' => $board->id, 'id' => $record->id]) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            #{{ $record->id }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $record->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $record->client->name ?? 'Не указан' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                {{ $record->user->name ?? 'Не назначен' }}
                            </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $record->client->phone ?? 'Не указан' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $record->client->email ?? 'Не указан' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('leed.item', ['board_id' => $board->id, 'id' => $record->id]) }}"
                               class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                Открыть
                            </a>

                            <!-- Перемещение в другой столбец -->
                            @if(Auth::user()->can('move', $record))
                                <select onchange="moveRecord(this.value, {{ $record->id }})"
                                        class="text-xs border border-gray-300 rounded px-2 py-1">
                                    <option value="">Переместить...</option>
                                    @foreach($columns as $column)
                                        @if($column->id != $selectedColumnId && $column->can_move)
                                            <option value="{{ $column->id }}">{{ $column->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        @if($search)
                            По запросу "{{ $search }}" ничего не найдено
                        @else
                            В этом столбце пока нет записей
                        @endif
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    @if($records->hasPages())
        <div class="mt-6">
            {{ $records->links() }}
        </div>
    @endif

    <!-- Сообщения -->
    @if (session()->has('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
</div>

<script>
    function moveRecord(columnId, recordId) {
        if (columnId && recordId) {
            if (confirm('Переместить запись в выбранный столбец?')) {
            @this.call('moveToColumn', recordId, columnId);
            }
        }
    }
</script>
