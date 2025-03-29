<main class="min-h-[550px]
            container mx-auto
            flex flex-col
            space-y-5
            lg:space-y-10
            ">
    <div class="w-full bg-yellow-300 py-3 text-center">
                <span class="text-lg font-bold">
                Демо версия, посмотреть, покликать
{{--                <button class="bg-blue-300 rounded px-3 py-1">Посмотреть!</button>--}}
                <a href="{{ route('leed') }}" wire:navigate class="bg-blue-300 rounded px-3 py-1">Посмотреть!</a>
                    </span>
        <br/>
{{--        каждые 2 часа все изменения сбрасываются на тестовый набор (шаги,пользователи,комментарии)--}}
        {{--                <button class="bg-blue-300 rounded px-3 py-1">Производство, посмотреть!</button>--}}
        {{--                <button class="bg-blue-300 rounded px-3 py-1">Услуги, посмотреть!</button>--}}
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
