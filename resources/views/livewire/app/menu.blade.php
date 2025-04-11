<div class="px-1 pt-5 text-[#c2c7d0] w-[200px]">

<div class="flex flex-col space-y-1">
    <ul>
        {{--        первая--}}
        {{--        <li class="w-full">--}}
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
        {{--        </li>--}}


        <!-- Лиды -->
        @permission('р.Лиды')
        <li class="w-full">
            <a href="{{ route('leed.list') }}"
               wire:navigate
               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('leed*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                </svg>
                <span>Рабочие доски</span>
            </a>
        </li>
        @endpermission

        <!-- Клиенты -->
        {{--        @can('р.Клиенты')--}}
        @permission('р.Клиенты')
        <li class="w-full">
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
        </li>
        @endpermission

        @if(1==2)
        <!-- Усдуги -->
        @permission('р.Заказы')
        <li class="w-full">
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
        </li>
        @endpermission

        @endif

        <!-- Усдуги -->
{{--        @permission('р.Услуги')--}}
{{--        <li class="w-full">--}}
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
{{--        </li>--}}
{{--        @endpermission--}}

        <!-- Сотрудники -->
        {{--        @can('р.Сотрудники')--}}
{{--        @permission('р.Сотрудники')--}}
{{--        <li class="w-full">--}}
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
{{--        </li>--}}
{{--        @endpermission--}}


        <!-- Договора -->
{{--        @permission('р.Договора')--}}
{{--        <li class="w-full">--}}
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

{{--                <li class="nav-item w-100 ">--}}
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
{{--                </li>--}}
{{--            </ul>--}}
{{--            @endpermission--}}
{{--        </li>--}}
{{--        @endpermission--}}

        <!-- Бухгалтерия -->
        @if(1==2)
        @anyPermission('р.Бух.Заказы','р.Бух.Услуги','р.Бух.Счета')
        <li class="w-full">
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
                <li class="nav-item w-100 ">
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
                </li>
                @endpermission

                @permission('р.Бух.Услуги')
                <li class="nav-item w-100">
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
                </li>
                @endpermission

                @permission('р.Бух.Счета')
                <li class="nav-item w-100">
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
                </li>
                @endpermission
            </ul>
        </li>
        @endanyPermission
        @endif

        {{--        user list--}}
        {{--        @permission('р.Пользователи')--}}
        {{--        <li class="w-full">--}}
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
        {{--        </li>--}}
        {{--        @endpermission--}}

        {{--        @permission('р.Права доступа')--}}
        {{--        <li class="w-full">--}}
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
        {{--        </li>--}}
        {{--        @endpermission--}}


        {{--        @permission('р.Поставщики лидов')--}}
        {{--        <li class="w-full">--}}
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
        {{--        </li>--}}
        {{--        @endpermission--}}

        {{--        @permission('тех.Управление столбцами')--}}
        {{--        <li class="w-full">--}}
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
        {{--        </li>--}}
        {{--        @endpermission--}}


        @permission('р.Техничка')
        <li class="w-full">
            <a href="{{ route('tech.index') }}"
               wire:navigate
               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('tech*') ? 'bg-orange-300 text-gray-700 ' : '' }}"
            >
                {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                {{--                </svg>--}}
                <img src="/icon/gear.svg" class="w-[18px]"/>
                <span>Тех. отдел</span>
            </a>
        </li>
        @endpermission


        @permission('р.Доски')
        <li class="w-full">
            <a href="{{ route('board') }}"
               wire:navigate
               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('board*') ? 'bg-orange-300 text-gray-700 ' : '' }}"
            >
                {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                {{--                </svg>--}}
                <img src="/icon/gear.svg" class="w-[18px]"/>
                <span>Доски</span>
            </a>
        </li>
        @endpermission


        <!-- CRM -->
@if(1==2)
        <li class="w-full">


            @if (App::environment('local'))
                <a href="https://crm.marudi.store"
                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
                   target="_blank"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
                    </svg>
                    <span>Перейти на crm.marudi.store</span>
                </a>
            @else
                <a href="https://marudi.store"
                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
                   target="_blank"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
                    </svg>
                    <span>marudi.store</span>
                </a>
            @endif
        </li>
@endif
    </ul>
</div>
</div>


