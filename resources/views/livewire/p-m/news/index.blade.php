<div>
    @if($news->count()>0)
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
        @if($showLinkInHead)
            <a href="{{ route('site.news.index') }}"
               class="hover:underline"
            wire:navigate >
            @endif
        <div class="p-6
    {{--    border-b border-gray-200--}}
        ">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Новости проекта</h2>
                {{--            <div class="w-full md:w-64">--}}
                {{--              --}}
                {{--            </div>--}}
            </div>
        </div>
                @if($showLinkInHead)
                    </a>
                        @endif

        <!-- Сортировка -->
        @if($showFilter)
            <div class="px-6 py-3 bg-gray-50 border-b border-gray-200
        flex flex-row
        ">
                <div class="flex-1 flex items-center space-x-4 text-sm text-gray-600">
                    <span>Сортировать:</span>
                    <button wire:click="sortBy('published_at')"
                            class="px-3 py-1 rounded hover:bg-gray-200 {{ $sortField === 'published_at' ? 'bg-gray-200 font-medium' : '' }}">
                        По дате
                        @if($sortField === 'published_at')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </button>
                    @if(1==2)
                        <button wire:click="sortBy('title')"
                                class="px-3 py-1 rounded hover:bg-gray-200 {{ $sortField === 'title' ? 'bg-gray-200 font-medium' : '' }}">
                            По названию
                            @if($sortField === 'title')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </button>
                    @endif
                </div>
                <div class="w-full md:w-[250px]">
                    <input type="text" wire:model.live="search"
                           placeholder="Поиск новостей..."
                           class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        @endif

        <!-- Список новостей -->
        <div class="
            {{--    divide-y divide-gray-200--}}
            flex flex-row flex-wrap
    {{--        space-x-2 space-y-2--}}
            ">
            @forelse($news as $item)

                <livewire:p-m.news.index-item :item="$item"
                                              :key="'news-item-'.$item->id"
                />

                @if(1==2)
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
                                            href="{{ route('site.news.show', $item) }}"
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
                                <a href="{{ route('site.news.show', ['id'=>$item]) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                    Читать далее
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </article>
                @endif

            @empty
                <!-- Пустой状态 -->
                <div class="p-12 text-center">
                    <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Новостей пока нет</h3>
                    <p class="text-gray-500">Здесь будут появляться последние новости проекта</p>

                    @auth
                        @can('create', App\Models\News::class)
                            <div class="mt-4">
                                <a href="{{ route('site.news.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Добавить первую новость
                                </a>
                            </div>
                        @endcan
                    @endauth
                </div>
            @endforelse
        </div>

    @if($showPages)
        <div class="w-8/12 mx-auto">
            {{$news->links('vendor.pagination.my1tailwind')}}
        </div>
    @endif
    @endif
</div>
