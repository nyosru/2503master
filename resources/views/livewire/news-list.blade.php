<div
{{--    class="bg-white rounded-lg shadow-lg"--}}
>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <!-- Заголовок и поиск -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Новости проекта</h2>

            <div class="w-full md:w-64">
                <input type="text" wire:model.live="search"
                       placeholder="Поиск новостей..."
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Сортировка -->
    <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
        <div class="flex items-center space-x-4 text-sm text-gray-600">
            <span>Сортировать:</span>
            <button wire:click="sortBy('published_at')"
                    class="px-3 py-1 rounded hover:bg-gray-200 {{ $sortField === 'published_at' ? 'bg-gray-200 font-medium' : '' }}">
                По дате
                @if($sortField === 'published_at')
                    @if($sortDirection === 'asc') ↑ @else ↓ @endif
                @endif
            </button>
            <button wire:click="sortBy('title')"
                    class="px-3 py-1 rounded hover:bg-gray-200 {{ $sortField === 'title' ? 'bg-gray-200 font-medium' : '' }}">
                По названию
                @if($sortField === 'title')
                    @if($sortDirection === 'asc') ↑ @else ↓ @endif
                @endif
            </button>
        </div>
    </div>

    <!-- Список новостей -->
    <div class="divide-y divide-gray-200">
        @forelse($news as $item)
            <article class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Изображение -->
                    @if($item->image)
                        <div class="md:w-48 flex-shrink-0">
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->title }}"
                                 class="w-full h-32 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <!-- Контент -->
                    <div class="flex-1">
                        <!-- Заголовок и дата -->
                        <div class="mb-3">
                            <h3 class="text-xl font-semibold text-gray-800 mb-1">
                                <a
                                    href="{{ route('news.show', $item) }}"
                                   class="hover:text-blue-600 transition-colors">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>{{ $item->published_at->format('d.m.Y H:i') }}</span>
                                <span>•</span>
                                <span>Автор: {{ $item->author->name }}</span>
                            </div>
                        </div>

                        <!-- Краткое содержание -->
                        @if($item->excerpt)
                            <p class="text-gray-600 mb-3 line-clamp-2">
                                {{ $item->excerpt }}
                            </p>
                        @else
                            <p class="text-gray-600 mb-3 line-clamp-3">
                                {{ Str::limit(strip_tags($item->content), 150) }}
                            </p>
                        @endif

                        <!-- Читать далее -->
                        <a href="{{ route('news.show', $item) }}"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Читать далее
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <!-- Пустой状态 -->
            <div class="p-12 text-center">
                <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Новостей пока нет</h3>
                <p class="text-gray-500">Здесь будут появляться последние новости проекта</p>

                @auth
                    @can('create', App\Models\News::class)
                        <div class="mt-4">
                            <a href="{{ route('news.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Добавить первую новость
                            </a>
                        </div>
                    @endcan
                @endauth
            </div>
        @endforelse
    </div>

    <!-- Пагинация или кнопка "Загрузить еще" -->
    @if($news->hasPages() && $news->count() > 0)
        <div class="px-6 py-4 border-t border-gray-200">
            @if($perPage >= $news->total())
                <!-- Стандартная пагинация -->
                <div class="flex justify-center">
                    {{ $news->links() }}
                </div>
            @else
                <!-- Кнопка "Загрузить еще" -->
                <div class="text-center">
                    <button wire:click="loadMore"
                            wire:loading.attr="disabled"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50">
                        <span wire:loading.remove>Загрузить еще</span>
                        <span wire:loading>Загрузка...</span>
                    </button>

                    <p class="mt-2 text-sm text-gray-500">
                        Показано {{ $news->count() }} из {{ $news->total() }} новостей
                    </p>
                </div>
            @endif
        </div>
    @endif

    <!-- Индикатор загрузки -->
{{--    <div wire:loading class="absolute inset-0 bg-white bg-opacity-50 flex items-center justify-center">--}}
{{--        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>--}}
{{--    </div>--}}
</div>
