<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ПроцессМастер.рф') }}</title>

    <link rel="icon" href="/favicons/favicon.ico"> <!-- 32×32 -->
    {{--    <link rel="icon" href="images/favicons/icon.svg" type="image/svg+xml">--}}
    <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">  <!-- 180×180 -->
    <link rel="manifest" href="/favicons/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <link href="/css/output.css?v={{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet">

</head>
<body class="antialiased font-sans bg-gray-100 min-h-screen">

<div class="min-h-screen flex flex-col">
    <div class="
{{--    bg-blue-100 bg-contain bg-no-repeat bg-center sm:bg-[url('/img/bg1.jpg')] --}}
    flex-grow flex-col space-y-5
    ">
        <header class="
        bg-gradient-to-bl from-gray-100 to-blue-200
        py-5
{{--        flex flex-col--}}
        ">

            <div class="container mx-auto text-center
            flex
            flex-col
            sm:flex-row
{{--            border-red-300 border-2--}}
            ">
                <div class="w-full sm:w-1/3 text-center text-2xl font-bold font-monospace py-3">
                    ПроцессМастер<small>.рф</small>
                </div>
                <div class="w-2/3 text-right py-3">
                    @if (Route::has('login'))
                        <livewire:welcome.navigation/>
                    @endif
                </div>
            </div>
        </header>

        <main class="min-h-[550px]
            container mx-auto
            flex flex-col
            space-y-5
            lg:space-y-10
            ">
{{--            <div class="w-full py-3 text-center">--}}
{{--                Система для ведения бизнес процессов и проектов: лиды, клиенты, производства, работы, услуги, фотоотчёты--}}
{{--                и многое другое.--}}
{{--            </div>--}}
            <div class="w-full bg-yellow-300 py-3 text-center">
                <span class="text-lg font-bold">
                Демо версия, посмотреть, покликать
                <a href="{{ route('leed') }}" wire:navigate class="bg-blue-300 rounded px-3 py-1">Посмотреть!</a>
                    </span>
                <br/>
                каждые 2 часа все изменения сбрасываются на тестовый набор (шаги,пользователи,комментарии)
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
                ПроцессМастер
                <button class="bg-blue-300 rounded px-3 py-1">Попробовать бесплатно!</button>
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
                        До 1 сентября 2025г идёт этап настройки приложения и бизнес процессов, присоединяйтесь, ваша
                        фиксированная <span class="bg-yellow-300 p-1 rounded">скидка 50%</span> навсегда
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
                            Взаимодействие работников с&nbsp;сервисом происходит в&nbsp;мобильном телефоне, телеграм и&nbsp;мобильный
                            сайт (отметка принял/сдал, подгрузка фото и&nbsp;оставить комментарии
                        </div>
                    </div>

                </div>
            </div>

        </main>

        <footer class="mx-auto container ">
            <div class="flex flex-col space-y-3  ">
                <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row">
                    <div class="w-full sm:w-1/2 text-center">&copy; Все права защищены {{ date('Y') }}</div>
                    <div class="w-full sm:w-1/2 text-center">Создание сервиса <a href="https://php-cat.com"
                                                                                 class="text-blue-600 hover:underline"
                                                                                 target="_blank">php-cat.com</a></div>
                </div>
        </footer>
    </div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) {
                return;
            }
        }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(100568272, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/100568272" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
