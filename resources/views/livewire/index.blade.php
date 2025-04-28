<main class="min-h-[550px]
            container mx-auto
            flex flex-col
            space-y-5
            lg:space-y-10
            ">

@if( strpos($_SERVER['HTTP_HOST'], '.local') !== false )
    <div>
        <a href="/a/1" >войти как админ</a>
        <br/>
        <a href="/a/2" >войти как руль</a>
        <br/>
        <a href="/a/3" >войти как мен</a>
        <br/>
    </div>
@endif

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
</main>
