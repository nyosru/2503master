<nav
    x-data="{ open: false }"
    class="bg-white border-b border-gray-100
     @guest() sticky top-0 @endguest
     "
>

    <div class="flex flex-col sm:w-full sm:flex-row space-y-2 pb-3">
        <div class="w-full sm:w-1/2 sm:pt-3 flex justify-center items-center py-2">
            <a href="/" class="hover:underline text-2xl pl-4 font-bold">
{{--                <livewire:app.navigation-upravlyator-logo />--}}
                <livewire:app.navigation-logo />
            </a>
        </div>
        <div class="sm:w-1/2 flex justify-center items-center ">
            @guest
                <livewire:auth.vk />
            @else
                <div>
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="inline xw-full text-start">
                            {{ auth()->user()->name ?? '-' }}
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute  border-2 border-gray-500 rounded
                         rounded shadow-lg z-10">
                            <div class="flex flex-col w-[150px] ">
                                <div class="">
                                    <a href="{{ route('lk.profile') }}"
                                       class="block bg-white px-4 py-2
                                        hover:bg-orange-200 hover:underline
                                        "
                                    >
                                        Профиль
                                    </a>
                                </div>
                                <div

                                >
                                    <a
                                        href="#"
                                        class=" bg-white px-4 py-2 hover:underline block
                                        hover:bg-orange-200
                                        "
                                        wire:click="logout"
                                    >
                                        Выйти
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>

</nav>
