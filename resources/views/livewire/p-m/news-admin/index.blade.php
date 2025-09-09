<div>
    <div class="p-6 bg-white shadow-sm border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Управление новостями</h2>

            <div class="flex gap-3">
                <a href="{{ route('tech.news-admin.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    + Добавить новость
                </a>
            </div>
        </div>
    </div>

    <!-- Фильтры и поиск -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Поиск по новостям..."
                       class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <select wire:model.live="boardFilter" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">Все новости</option>
                    <option value="without">Без привязки к доске</option>
                    @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <select wire:model.live="sortField" class="flex-1 p-2 border border-gray-300 rounded-lg">
                    <option value="published_at">По дате</option>
                    <option value="title">По названию</option>
                </select>
                <button wire:click="sortDirection = '{{ $sortDirection === 'asc' ? 'desc' : 'asc' }}'"
                        class="px-3 py-2 border border-gray-300 rounded-lg">
                    {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Таблица новостей -->
    <div class="bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Заголовок</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Доска</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($news as $item)
                    <tr wire:key="news-{{ $item->id }}">
                        <td class="px-6 py-4
{{--                        whitespace-nowrap--}}
                        ">
                            @if( !empty($item->image_url) )
                            <img src="{{ $item->image_url }}"
                                 alt="img"
                                 class="w-[60px] float-left mr-2"/>
                            @endif
                            <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                            <div class="text-sm text-gray-500 line-clamp-2">{{ $item->excerpt }}</div>
                        </td>
                        <td class="px-6 py-4
{{--                        whitespace-nowrap--}}
                        ">
                                <span class="text-sm text-gray-900">
                                    {{ $item->board?->name ?? '—' }}
                                </span>
                        </td>
                        <td class="px-6 py-4
{{--                        whitespace-nowrap--}}
                        ">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $item->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $item->is_published ? 'Опубликовано' : 'Черновик' }}
                                </span>
                        </td>
                        <td class="px-6 py-4
{{--                        whitespace-nowrap --}}
                        text-sm text-gray-500">
                            {{ $item->published_at?->format('d.m.Y H:i') ?? '—' }}
                        </td>
                        <td class="px-6 py-4
{{--                        whitespace-nowrap --}}
                        text-sm font-medium">
                            <div class="flex flex-col">

                                <button wire:click="togglePublish({{ $item->id }})"
                                        class="text-gray-600 hover:text-gray-900">
                                    {{ $item->is_published ? 'Снять' : 'Опубликовать' }}
                                </button>

<div>&nbsp;</div>
                                <a href="{{ route('tech.news-admin.edit', $item->id) }}"
                                   class="text-blue-600 hover:text-blue-900">Редактировать</a>

                                <button wire:click="deleteNews({{ $item->id }})"
{{--                                        onclick="return confirm('Удалить новость?')"--}}
                                        wire:confirm="Удалить новость?"
                                        class="text-red-600 hover:text-red-900">Удалить</button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Новостей не найдено
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="px-6 py-4 bg-white border-t border-gray-200">
            {{ $news->links() }}
        </div>
    </div>

    <!-- Flash сообщения -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</div>
