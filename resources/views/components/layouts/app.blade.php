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
    {{--    @livewireStyles--}}

</head>
<body class="antialiased font-sans bg-gray-100 min-h-screen">
{{--@if(request()->getHost() == 'xn--80ajb0aifhffacm9b.xn--p1ai')--}}
@if(1==2)

    <h1 class="bg-yellow-300 p-3 mt-5 rounded text-2xl text-blue-700 text-center">небольшие изменения<br/>
        Домен <u>ПроцессМастер.рф</u> переезжаем на <a href="https://Управлятор.рф" class="underline">Управлятор.рф</a>
    </h1>

@else
    <div class=" ">
        <div class="min-h-screen flex flex-col relative">
            <div class="flex-grow flex-row space-y-5">
                <livewire:app.navigation/>
                <div class="flex flex-col space-x-5">
                    @if (Route::is('tech*')
                        || Route::is('lk*')
                        || Route::is('board*')
                        || Route::is('leed*')
                        || Route::is('clients*')
                        || Route::is('order*')
                        || Route::is('vk*')
                        )
                        <livewire:app.menu/>
                    @endif

                    {{--                        если техничка то меню сверху--}}
                    @if (Route::is('tech*') )
                        <livewire:tech.menu/>
                    @endif

                    <div class="flex-1 min-h-[400px]">
                        {{ $slot ?? '' }}
                        @yield('content' , '' )
                    </div>
                </div>

                <livewire:app.footer/>
            </div>

            @if(1==2)
                <div class="min-h-screen flex flex-col">
                    <div class="flex-grow flex-col space-y-5">
                        <header class="bg-gradient-to-bl from-gray-100 to-blue-200py-5">
                            <div class="container mx-auto text-center flex flex-col sm:flex-row ">
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

                        <main class="min-h-[550px] container mx-auto flex flex-col space-y-5 lg:space-y-10 ">
                            <div class="w-full bg-yellow-300 py-3 text-center">
<span class="text-lg font-bold">
Демо версия, посмотреть, покликать
<button class="bg-blue-300 rounded px-3 py-1">Посмотреть!</button>
</span>
                                <br/>
                                каждые 2 часа все изменения сбрасываются на тестовый набор
                                (шаги,пользователи,комментарии)
                            </div>

                            <div class="w-full flex flex-col space-x-5 lg:flex-row space-y-5 ">
                                <div class="w-full lg:w-1/2">
                                    <div class="w-full flex flex-row space-x-5 ">
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
                                    <div class="w-full flex flex-row  space-x-5 ">
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

                            <div class="w-full flex flex-col space-x-5 lg:flex-row space-y-5 ">
                                <div class="w-full lg:w-1/2">
                                    <div class="w-full max-w-[350px] mx-auto rounded border-l-[10px] border-yellow-300 p-2">
                                        <img src="/icon/time-date.png" class="w-[50px] m-2 float-left"/>
                                        До 1 сентября 2025г идёт этап настройки приложения и бизнес процессов,
                                        присоединяйтесь,
                                        ваша фиксированная <span class="bg-yellow-300 p-1 rounded">скидка 50%</span>
                                        навсегда
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2">
                                    <div class="w-full flex flex-row space-x-5 ">
                                        <div class="w-[150px]">
                                            <img src="/icon/share.png" class="w-[132px] float-right"/>
                                        </div>
                                        <div class="flex-1">
                                            Взаимодействие работников с&nbsp;сервисом происходит в&nbsp;мобильном
                                            телефоне,
                                            телеграм и&nbsp;мобильный
                                            сайт (отметка принял/сдал, подгрузка фото и&nbsp;оставить комментарии
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </main>

                        <footer class="mx-auto container ">
                            <div class="flex flex-col space-y-3  ">
                                <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row">
                                    <div class="w-full sm:w-1/2 text-center">&copy; Все права
                                        защищены {{ date('Y') }}</div>
                                    <div class="w-full sm:w-1/2 text-center">Создание сервиса <a
                                            href="https://php-cat.com"
                                            class="text-blue-600 hover:underline"
                                            target="_blank">php-cat.com</a>
                                    </div>
                                </div>
                        </footer>
                    </div>
                </div>
            @endif

            @livewireScripts

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (m, e, t, r, i, k, a) {
                    m[i] = m[i] || function () {
                        (m[i].a = m[i].a || []).push(arguments);
                    };
                    m[i].l = 1 * new Date();
                    for (var j = 0; j < document.scripts.length; j++) {
                        if (document.scripts[j].src === r) {
                            return;
                        }
                    }
                    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                        k, a);
                })
                (window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');

                ym(100568272, 'init', {
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            </script>
            <noscript>
                <div><img src="https://mc.yandex.ru/watch/100568272" style="position:absolute; left:-9999px;" alt=""/>
                </div>
            </noscript>
            <!-- /Yandex.Metrika counter -->
        </div>
    </div>
@endif
</body>
</html>
