<div class="
{{--px-1 pt-5 --}}
text-[#c2c7d0]
{{-- border border-3 border-blue-300--}}
flex flex-row flex-wrap
w-full
{{--space-y-1--}}
space-x-1
justify-center
">

    {{--        <div>--}}

    {{--        первая--}}
    {{--        <div class="xw-full">--}}
    {{--            <a href="{{ route('cms2.index') }}"--}}
    {{--               wire:navigate--}}
    {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
    {{--                hover:bg-orange-200 hover:text-gray-700 --}}
    {{--                {{ Request::routeIs('cms2.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
    {{--            >--}}
    {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
    {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
    {{--                </svg>--}}
    {{--                <span>Навигатор</span>--}}
    {{--            </a>--}}
    {{--        </div>--}}


    {{--        @can('р.Клиенты')--}}
    @permission('р.Клиенты')
    <div>
        <a href="{{ route('clients') }}"
           wire:navigate
           class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('clients*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
            </svg>
            <span>Клиенты</span>
        </a>
    </div>
    @endpermission

    @permission('р.Доски')
    <livewire:app.menu-item :route="route('board.list')"
                            :active="Request::is('board*')"
                            name="Рабочие доски"
                            img="/icon/gear.svg"
                            :key="'mnu-docki'"/>
    @endpermission


    @permission('р.Техничка')
    <livewire:app.menu-item :route=" route('tech.index') " :active="Request::is('tech*')" name="Тех. отдел"
                            img="/icon/gear.svg"
                            :key="'mnu-tech-i'"/>
    @endpermission


    <!-- Лиды -->
    @permission('р.Лиды')
    <livewire:app.menu-item :route="route('leed.list')"
                            :active="Request::is('leed*')"
                            name="Д"
                            {{--                            img="/icon/gear.svg"--}}
                            :key="'mnu-docki-leed'"/>
    @endpermission


    @permission('Разработка')
    <livewire:app.menu-item :route="route('vk.friend')" :active="Request::routeIs('vk.friend')" name="vk friends"
                            img="/icon/gear.svg"
                            :key="'mnu-vk-friends'"/>
    @endpermission


    @if(1==2)

        @if(1==2)
            <!-- Усдуги -->
            @permission('р.Заказы')
            <div class="xw-full">
                <a href="{{ route('order.index') }}"
                   wire:navigate
                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::routeIs('order.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>
                    </svg>
                    <span>Заказы</span>
                </a>
            </div>
            @endpermission

        @endif

        <!-- Усдуги -->
        {{--        @permission('р.Услуги')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('uslugi.index') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700--}}
        {{--                {{ Request::routeIs('uslugi.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Услуги</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}

        <!-- Сотрудники -->
        {{--        @can('р.Сотрудники')--}}
        {{--        @permission('р.Сотрудники')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('staff.index') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700--}}
        {{--                {{ Request::is('staff*') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Сотрудники</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}


        <!-- Договора -->
        {{--        @permission('р.Договора')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('dogovor.index') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700--}}
        {{--                {{ Request::is('dogovor*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
        {{--                "--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v8H6V6z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Договора</span>--}}
        {{--            </a>--}}


        {{--            @permission('р.Договора / Шаблоны')--}}
        {{--            <ul class="ml-[20px] nav nav-treeview w-100">--}}

        {{--                <div class="nav-item w-100 ">--}}
        {{--                    <a href="{{ route('dogovor.template') }}"--}}
        {{--                       wire:navigate--}}
        {{--                       --}}{{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
        {{--                       class="flex items-center--}}
        {{--                        m-1 px-4 py-1 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700--}}
        {{--                {{ Request::routeIs('dogovor.template') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
        {{--                "--}}
        {{--                    >--}}
        {{--                        --}}{{--                    <i class="nav-icon bi bi-circle"></i>--}}
        {{--                        Шаблоны--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--            </ul>--}}
        {{--            @endpermission--}}
        {{--        </div>--}}
        {{--        @endpermission--}}

        <!-- Бухгалтерия -->
        @if(1==2)
            @anyPermission('р.Бух.Заказы','р.Бух.Услуги','р.Бух.Счета')
            <div class="xw-full">
                <div
                    {{--            <a href="{{ route('buh.zakazs') }}"--}}
                    class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('buh*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm4 6h6a1 1 0 110 2H9a1 1 0 110-2z"/>
                    </svg>
                    <span>Бухгалтерия</span>
                    {{--            </a>--}}
                </div>


                <ul class="ml-[20px] nav nav-treeview w-100">

                    @permission('р.Бух.Заказы')
                    <div class="nav-item w-100 ">
                        <a href="{{ route('buh.zakazs') }}"
                           wire:navigate
                           {{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
                           class="flex items-center
                        m-1 px-4 py-1 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::routeIs('buh.zakazs') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                        >
                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                            Заказы
                        </a>
                    </div>
                    @endpermission

                    @permission('р.Бух.Услуги')
                    <div class="nav-item w-100">
                        <a href="{{ route('buh.uslugi') }}"
                           wire:navigate
                           class="flex items-center m-1 px-4 py-1 xtext-gray-700 rounded
                            hover:bg-orange-200 hover:text-gray-700
                            {{ Request::routeIs('buh.uslugi') ? 'bg-orange-300 text-gray-700 ' : '' }}
                        "

                        >
                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                            Услуги
                        </a>
                    </div>
                    @endpermission

                    @permission('р.Бух.Счета')
                    <div class="nav-item w-100">
                        <a href="{{ route('buh.sheta') }}"
                           wire:navigate
                           {{--                       class="nav-link {{ request()->routeIs('buh.sheta') ? 'active' : '' }}"--}}
                           class="flex items-center
                        m-1 px-4 py-1 xtext-gray-700 rounded
                        hover:bg-orange-200 hover:text-gray-700
                        {{ Request::routeIs('buh.sheta') ? 'bg-orange-300 text-gray-700 ' : '' }}
                        "

                        >
                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                            Счета
                        </a>
                    </div>
                    @endpermission
                </ul>
            </div>
            @endanyPermission
        @endif

        {{--        user list--}}
        {{--        @permission('р.Пользователи')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('user_list') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
        {{--                {{ Request::routeIs('user_list') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Пользователи</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}

        {{--        @permission('р.Права доступа')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('role_permission') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
        {{--                {{ Request::routeIs('role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Права доступа</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}


        {{--        @permission('р.Поставщики лидов')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('ClientSupplierManager') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 text-gray-600 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
        {{--                {{ Request::routeIs('ClientSupplierManager') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Источники лидов</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}

        {{--        @permission('тех.Управление столбцами')--}}
        {{--        <div class="xw-full">--}}
        {{--            <a href="{{ route('adm_role_column') }}"--}}
        {{--               wire:navigate--}}
        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
        {{--                {{ Request::routeIs('adm_role_column') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
        {{--                </svg>--}}
        {{--                <span>Путь заказа, доступы</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        @endpermission--}}
    @endif

</div>


