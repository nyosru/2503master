<div class="xw-full">
{{--    {{ $route }}--}}
    <a href="{{ $route }}"
       wire:navigate
       class="flex
       items-center space-x-2 px-4
       py-2
{{--       xtext-gray-700 --}}
       rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ $active ? 'bg-orange-300 text-gray-700 ' : '' }}"
    >
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        @if( !empty($img) )
            <img src="{{ $img }}" class="w-[18px] float-left mr-2"/>
        @endif

        {{ $name }}
    </a>
</div>
