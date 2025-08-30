<main class="min-h-[550px]
            container mx-auto
            flex flex-col
            space-y-5
            lg:space-y-10
            ">

    @if(1==2)
    @if( strpos($_SERVER['HTTP_HOST'], '.local') !== false )
        <div>
            <a href="/a/1">войти как админ</a> /
            <a href="/a/2">войти как руль</a> /
            <a href="/a/3">войти как мен</a> /
        </div>
    @endif
    @endif

    @if(1==2)
    @if(1==2)
        <div class="w-full" x-data="{ showButtons: true }">

            <div class="w-full bg-yellow-300 py-3 text-center">
            <span class="text-lg font-bold">
                Демо версия, посмотреть, покликать
{{--                <button type="button" class="bg-blue-300 rounded px-3 py-1"--}}
                {{--                        @click="showButtons = !showButtons">Попробовать в тест досках!</button>--}}
            </span>
            </div>

            <div x-show="showButtons"
                 class="w-[80%]
             bg-yellow-100
             border-l-4 border-yellow-300
             mx-auto flex flex-col justify-center"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
            >
                {{--            <div class="w-full p-2 text-xl text-center font-bold">--}}
                {{--                варианты использования процесс мастер--}}
                {{--            </div>--}}

                <div class="p-2 w-full flex flex-row hover:bg-yellow-200">
                    <div class="w-3/4 flex items-top
                flex-col md:flex-row

                ">
                        <div class="w-[120px]">
                            <img src="/icon/team1.jpg" class="h-[80px] mr-2 rounded-full" alt="team1">
                        </div>
                        <div class="flex-1">
                            <b>Самозанятый</b> Владелец бизнеса
                            <div class="mt-2">
                                система используется для:

                                <ul class="list-disc ml-5">
                                    <li>учёт клиентов</li>
                                    <li>ведение заказов</li>
                                    <li>напоминания себе в телеграм</li>
                                    <li>по изменениям этапов заказа -> сообщение в телеграм клиенту</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 w-1/4 text-center items-middle">
                        тестовая версию доски<br/>
                        {{--                    самозанятый - сам всё делаешь, делаешь отметки и ведёшь свои заказы/обьекты/лиды--}}
                        <a href="{{ route('go-to-test.sz') }}" class="bg-blue-300 rounded px-3 py-1">Посмотреть</a>
                        <br/>
                        {{--                    <a href="{{ route('go-to-test.manager') }}" class="bg-blue-300 rounded px-3 py-1">Войти как--}}
                        {{--                        работник</a>--}}
                    </div>
                </div>

                @if(1==2)
                    <div class="p-2 w-full flex flex-row hover:bg-yellow-200">
                        <div class="w-1/2 flex items-center">
                            <img src="/icon/team3.png" class="h-[80px] mr-2 float-left rounded-full" alt="team1">
                            Есть руководитель процесса и исполнитель(и)
                        </div>
                        <div class="p-2 w-1/2">
                            <a href="{{ route('go-to-test.ruk') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                руководитель</a>
                            <br/>
                            <a href="{{ route('go-to-test.manager') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                работник 1</a>
                            <Br/>
                            <a href="{{ route('go-to-test.manager') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                работник 2</a>
                        </div>
                    </div>
                @endif

                @if(1==2)
                    <div class="p-2 w-full flex flex-row hover:bg-yellow-200">
                        <div class="w-1/2 flex items-center">
                            <img src="/icon/team-full.webp" class="h-[80px] mr-2 float-left rounded-full" alt="team1">
                            Организация ( руководитель процесса и исполнитель(и) которые передают заказ друг другу, один
                            закрывает заказ по его готовности )
                        </div>
                        <div class="p-2 w-1/2">
                            <a href="{{ route('go-to-test.ruk') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                руководитель</a>
                            <br/>
                            <a href="{{ route('go-to-test.manager') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                работник 1</a>
                            <br/>
                            <a href="{{ route('go-to-test.manager') }}" class="bg-blue-300 rounded px-3 py-1">Войти как
                                работник 2</a>
                        </div>
                    </div>
                @endif

            </div>


        </div>
    @endif

    {{--            <div class="w-full flex flex-row--}}
    {{--            space-x-5--}}
    {{--            ">--}}
    {{--                <div class="w-1/2"></div>--}}
    {{--                <div class="w-1/2">22</div>--}}
    {{--            </div>--}}
    <div class="w-full flex
            flex-col space-x-5
            lg:flex-row space-y-5

            ">
        <div class="w-full lg:w-1/2">
            <div class="w-full flex flex-row
            space-x-5
            ">
                <div class="w-[150px]">
                    <img src="/icon/checklist.png" class="w-[132px] float-right"/>
                </div>
                <div class="flex-1">
                    <ul>
                        <li>Управление, ведение и история работы с Лидами</li>
                        <li>Производство изделия с передачей по этапам от спеца к спецу</li>
                        <li>Контроль стройки (фотоотчёты по этапам строительства)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <div class="w-full flex flex-row
            space-x-5
            ">
                <div class="w-[150px]">
                    <img src="/icon/checklist2.png" class="w-[132px] float-right"/>
                </div>
                <div class="flex-1">
                    <ul>
                        <li>Роли участников</li>
                        <li>Распределённый доступ</li>
                        <li>Фиксация рабочих процессов</li>
                        <li>Отметки о приёмке/сдаче своего этапа</li>
                        <li>База контактных данных</li>
                        <li>Работа со складом</li>
                        <li>Аналитика статистики и времени производства</li>
                        <li>Свой домен для работы</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-yellow-300 py-3 text-center">
        {{--        ПроцессМастер--}}
        {{--        <button class="bg-blue-300 rounded px-3 py-1">Попробовать бесплатно!</button>--}}
    </div>

    {{--            <div class="w-full flex flex-row--}}
    {{--            space-x-5--}}
    {{--            ">--}}
    {{--                <div class="w-1/2">Штучки</div>--}}
    {{--                <div class="w-1/2">--}}

    {{--                </div>--}}
    {{--            </div>--}}

    <div class="w-full flex
            flex-col space-x-5
            lg:flex-row space-y-5

            ">
        <div class="w-full lg:w-1/2">
            <div class="w-full max-w-[350px] mx-auto rounded
{{--                    bg-yellow-300 --}}
                    border-l-[10px] border-yellow-300
                    p-2">
                <img src="/icon/time-date.png" class="w-[50px] m-2 float-left"/>
                До 1 сентября 2025г идёт этап настройки приложения и бизнес процессов, присоединяйтесь,
                ваша фиксированная <span class="bg-yellow-300 p-1 rounded">скидка 50%</span> навсегда
            </div>
        </div>
        <div class="w-full lg:w-1/2">

            <div class="w-full flex flex-row
            space-x-5
            ">
                <div class="w-[150px]">
                    <img src="/icon/share.png" class="w-[132px] float-right"/>
                </div>
                <div class="flex-1">
                    Взаимодействие работников с&nbsp;сервисом происходит в&nbsp;мобильном телефоне,
                    телеграм и&nbsp;мобильный
                    сайт (отметка принял/сдал, подгрузка фото и&nbsp;оставить комментарии
                </div>
            </div>

        </div>
    </div>
        @endif

{{--        <livewire:news-list />--}}

        @if(1==2)
        <nav class="bg-white shadow-md py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-blue-600 text-white p-2 rounded-lg mr-2">
                        <i class="fas fa-trello text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-blue-600">KanbanCRM</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-blue-600">Возможности</a>
                    <a href="#" class="hover:text-blue-600">Тарифы</a>
                    <a href="#" class="hover:text-blue-600">Контакты</a>
                </div>
                <div>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300">Войти</a>
                </div>
            </div>
        </nav>
@endif



        <!-- Герой секция -->a
        <section class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">Управляйте лидами с помощью интуитивных канбан-досок</h1>
                    <p class="text-lg text-gray-700 mb-8">Создавайте собственные доски, перемещайте задачи между колонками, назначайте права доступа сотрудникам и повышайте эффективность вашей команды.</p>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-medium shadow-lg transition duration-300 transform hover:-translate-y-1 inline-flex items-center">
                        Попробовать бесплатно
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <p class="mt-4 text-gray-600">Первый месяц бесплатно, без необходимости привязывать карту</p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-lg">
                        <div class="absolute -top-6 -left-6 w-64 h-64 bg-blue-200 rounded-lg opacity-50 animate-pulse"></div>
                        <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-purple-200 rounded-lg opacity-50 animate-pulse delay-500"></div>
                        <div class="relative bg-white p-6 rounded-xl shadow-xl border border-gray-200">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="font-bold text-lg">Доска продаж</h3>
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex space-x-4 overflow-x-auto pb-4">
                                <!-- Колонка 1 -->
                                <div class="bg-gray-100 p-4 rounded-lg min-w-[250px]">
                                    <h4 class="font-medium mb-4 text-gray-700">Новые лиды</h4>
                                    <div class="bg-white p-3 rounded shadow mb-3 border-l-4 border-blue-500">
                                        <p class="font-medium">Иван Петров</p>
                                        <p class="text-sm text-gray-600">Заинтересован в услугах</p>
                                    </div>
                                    <div class="bg-white p-3 rounded shadow mb-3 border-l-4 border-green-500">
                                        <p class="font-medium">ООО "Ромашка"</p>
                                        <p class="text-sm text-gray-600">Корпоративный клиент</p>
                                    </div>
                                </div>

                                <!-- Колонка 2 -->
                                <div class="bg-gray-100 p-4 rounded-lg min-w-[250px]">
                                    <h4 class="font-medium mb-4 text-gray-700">В работе</h4>
                                    <div class="bg-white p-3 rounded shadow mb-3 border-l-4 border-yellow-500">
                                        <p class="font-medium">Петр Сидоров</p>
                                        <p class="text-sm text-gray-600">Ждет коммерческое предложение</p>
                                    </div>
                                </div>

                                <!-- Колонка 3 -->
                                <div class="bg-gray-100 p-4 rounded-lg min-w-[250px]">
                                    <h4 class="font-medium mb-4 text-gray-700">Сделка заключена</h4>
                                    <div class="bg-white p-3 rounded shadow mb-3 border-l-4 border-purple-500">
                                        <p class="font-medium">Анна Иванова</p>
                                        <p class="text-sm text-gray-600">Подписан договор</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-6 space-x-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">М</div>
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white">А</div>
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white">С</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-12 bg-white">
            <livewire:PM.News.index perPage="3" :showFilter="false" />
        </section>
        <!-- Возможности -->

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-4">Мощные возможности для вашего бизнеса</h2>
                <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">Наша CRM-система предоставляет все необходимое для эффективного управления лидами и повышения конверсии</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Возможность 1 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-blue-100 w-14 h-14 rounded-lg flex items-center justify-center text-blue-600 mb-4">
                            <i class="fas fa-columns text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Гибкие канбан-доски</h3>
                        <p class="text-gray-600">Создавайте неограниченное количество досок с настраиваемыми колонками под ваши бизнес-процессы.</p>
                    </div>

                    <!-- Возможность 2 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-green-100 w-14 h-14 rounded-lg flex items-center justify-center text-green-600 mb-4">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Управление доступом</h3>
                        <p class="text-gray-600">Назначайте права доступа сотрудникам, контролируйте кто что видит и редактирует.</p>
                    </div>

                    <!-- Возможность 3 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-purple-100 w-14 h-14 rounded-lg flex items-center justify-center text-purple-600 mb-4">
                            <i class="fas fa-arrows-alt text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Перетаскивание карточек</h3>
                        <p class="text-gray-600">Интуитивное перемещение карточек между колонками для визуального отображения прогресса.</p>
                    </div>

                    <!-- Возможность 4 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-yellow-100 w-14 h-14 rounded-lg flex items-center justify-center text-yellow-600 mb-4">
                            <i class="fas fa-bell text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Уведомления</h3>
                        <p class="text-gray-600">Получайте уведомления об изменениях, назначениях и приближающихся дедлайнах.</p>
                    </div>

                    <!-- Возможность 5 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-red-100 w-14 h-14 rounded-lg flex items-center justify-center text-red-600 mb-4">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Аналитика и отчеты</h3>
                        <p class="text-gray-600">Отслеживайте эффективность вашей команды с помощью встроенных отчетов и аналитики.</p>
                    </div>

                    <!-- Возможность 6 -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition duration-300">
                        <div class="bg-indigo-100 w-14 h-14 rounded-lg flex items-center justify-center text-indigo-600 mb-4">
                            <i class="fas fa-mobile-alt text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Мобильное приложение</h3>
                        <p class="text-gray-600">Работайте с вашими лидами где угодно с помощью мобильного приложения для iOS и Android.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA секция -->
        <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-6">Готовы повысить эффективность вашей команды?</h2>
                <p class="text-blue-100 max-w-2xl mx-auto mb-10">Присоединяйтесь к десяткам компаний (и ИП), которые уже используют ПроцессМастер
                    для управления своими лидами и ведения мониторинга и повышения конверсии.</p>
                <a href="#" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-medium shadow-lg transition duration-300 transform hover:scale-105 inline-flex items-center">
                    Попробовать бесплатно
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
{{--                <p class="mt-4 text-blue-200">14 дней бесплатно, без кредитной карты</p>--}}
            </div>
        </section>


</main>
