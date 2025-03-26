<div class="flex min-h-screen ... relative">

    {{--    левый блок--}}

    <div id="sidebar_left"
         class="flex-none w-[200px] bg-gradient-to-tl from-gray-100 to-gray-200 transition-all duration-800">

        <a href="/" title="Marudi">
            <div class="px-6 bg-gray-700 shadow">
                <img src="/logo1.png" alt="Marudi" class="py-5">
            </div>
        </a>

        <div class="sticky sticky-top top-0 sticky-top ">
            @include('cms2.menu')
        </div>

    </div>

    <div class="grow">

        <div class="p-3">
            {{--            сворачиваем меню--}}

            @if(1==1)
                <button
                    id="toggleSidebarBtn"
                    class="text-2xl text-gray-600 px-2 pt-1 pb-2 hover:bg-blue-100 transition duration-300 rounded"
                    title="Скрыть/показать Левое меню"
                    onclick="document.getElementById('sidebar_left').classList.toggle('hidden');"
                >
                    ☰
                </button>
            @endif

            <span style="float:right;">

{{--                pass: {{ $pass }}--}}

                <input type="password" name="pass" size="5" value="" wire:model.live="pass"
                       class="border border-1 border-green-500"
{{--                       wire:keydown.enter="updatePass({{$someInput}})"--}}
                />

            </span>
        </div>

        <div class="bg-orange-100">
            <div class="px-3 pt-5 min-h-screen">
                {{ $slot }}
            </div>
            @include('cms2.footer')
        </div>
    </div>
</div>

