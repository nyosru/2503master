<article class="w-full md:w-1/2 xl:w-1/3 p-6">
{{--    {{ $item->image_url }}--}}
    <div class="relative bg-white shadow-md rounded-lg p-3 overflow-hidden">
        <!-- Блюр-фон -->
        @if($item->image)
            <div class="absolute inset-0 z-0 opacity-30">
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->title }}"
                     class="w-full h-full object-cover filter blur-md scale-110">
            </div>
        @endif

        <div class="relative z-10 flex
{{--        flex-col--}}
        flex-row
        md:flex-row gap-6">
            <!-- Изображение -->
            @if($item->image)
                <div class="w-24 md:w-32 flex-shrink-0">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title }}"
                         class="w-full h-24 object-cover rounded-lg shadow-md border-2 border-white">
                </div>
            @endif

            <!-- Контент -->
            <div class="flex-1">
                <!-- Заголовок и дата -->
                <div class="mb-3">
                    <h3 class="text-xl font-semibold text-gray-800 mb-1">
                        <a href="{{ route('site.news.show', $item) }}"
                           class="hover:text-blue-600 transition-colors">
                            {{ $item->title }}
                        </a>
                    </h3>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <span>{{ $item->published_at->format('d.m.Y') }}</span>
                    </div>
                </div>

                <!-- Краткое содержание -->
                @if($item->excerpt)
                    <p class="text-gray-700 mb-3 line-clamp-2">
                        {{ $item->excerpt }}
                    </p>
                @else
                    <p class="text-gray-700 mb-3 line-clamp-3">
                        {{ Str::limit(strip_tags($item->content), 450) }}
                    </p>
                @endif

                <!-- Читать далее -->
                <a href="{{ route('site.news.show', ['id'=>$item]) }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Читать далее
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>
