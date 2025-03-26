<div x-data="{parentCommentId: null}" class="flex flex-col">

    <div class="p-2 text-lg border-b ">
        {{--                    <div class="inline float-right">1 2 3</div>--}}
        <span class="font-bold">Коментарии</span>
    </div>
    <div class="p-2">

        {{-- Список комментариев --}}
        <div class="h-[430px] flex flex-col relative">

            <div class="h-[430px] overflow-y-auto flex flex-col space-y-3 " id="scrollable-block">
                @foreach($comments as $comment)
{{--                {{$comment->id}}--}}
{{--                    <pre class="text-xs">{{ print_r($comment->toArray()) }}</pre>--}}
{{--                    @if( sizeof($comment->files) > 0 || !empty($comment->comment) )--}}
                        <div class="flex flex-col space-y-1" style="z-index: 3;">
                            <livewire:cms2.leed.comment-msg-head :comment="$comment"/>
                        </div>
{{--                    @else--}}
{{--                        ..--}}
{{--                    @endif--}}
                @endforeach
            </div>


            <!-- Стрелка для прокрутки вниз -->
            <button id="scroll-to-bottom"
                    type="button"
                    class="absolute bottom-2 right-[10px] bg-gray-500/50 p-2 rounded-full shadow-md
                        z-10
                        hover:bg-gray-300"
                    style="display: none;">
                <svg class="h-9 w-9 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"/>
                </svg>
            </button>

{{--            стрелка для спуска вниз--}}
{{--            <div class="p-1 xtext-right w-full xbg-white/50">--}}
{{--                <button id="scroll-to-bottom" type="button"--}}
{{--                        class="xrounded-xl xbg-gray-400 xmt-[-60px] p-1 float-right">--}}
{{--                    --}}{{--                &darr;&darr;&darr;--}}
{{--                    <svg class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"/>--}}
{{--                    </svg>--}}

{{--                </button>--}}
{{--            </div>--}}

        </div>
    </div>

    <div class="p-2 bg-gray-200 h-[150px]">
        <livewire:cms2.leed.leed-comment-add :leed_record_id="$leed_record_id"/>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollableField = document.getElementById('scrollable-block');
            const scrollToBottomButton = document.getElementById('scroll-to-bottom');

            // Проверка прокрутки при загрузке страницы
            checkScrollPosition();

            // Показывать кнопку только если поле не прокручено до низа
            scrollableField.addEventListener('scroll', function() {
                checkScrollPosition();
            });

            // Функция для проверки прокрутки
            function checkScrollPosition() {
                const isScrolledToBottom = scrollableField.scrollHeight - scrollableField.scrollTop ===
                    scrollableField.clientHeight;
                scrollToBottomButton.style.display = isScrolledToBottom ? 'none' : 'block';
            }

            // Прокрутить поле до конца при клике на кнопку
            scrollToBottomButton.addEventListener('click', function() {
                scrollableField.scrollTop = scrollableField.scrollHeight - scrollableField.clientHeight;
            });
        });
    </script>

</div>

