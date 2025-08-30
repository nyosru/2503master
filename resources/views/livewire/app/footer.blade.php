<div class="pt-3 bg-gray-200">
    <footer>

        <div class="mx-auto container ">
            <div class="flex flex-row py-3">

                <div class="w-1/4">
                    <div class="flex items-center mb-4">
{{--                        <div class="bg-blue-600 text-white p-2 rounded-lg mr-2">--}}
{{--                            <i class="fas fa-trello"></i>--}}
{{--                        </div>--}}
{{--                        <span class="text-xl font-bold">KanbanCRM</span>--}}
                        <a href="/" class="text-xl font-bold hover:underline">
                            Пр<svg class="inline-block w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>цессМастер<small>.рф</small>
                        </a>
                    </div>
                    <p class="text-gray-400">Упрощаем управление лидами, процессами и&nbsp;задачами для мониторинга и&nbsp;повышения эффективности.</p>
                </div>

                <div class="w-1/4">
                    <h4 class="font-bold text-lg mb-4">
                        Система
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('site.news.index') }}" class="text-gray-400 hover:text-white">Новости</a></li>
{{--                        <li><a href="#" class="text-gray-400 hover:text-white">Возможности</a></li>--}}
{{--                        <li><a href="#" class="text-gray-400 hover:text-white">Тарифы</a></li>--}}
{{--                        <li><a href="#" class="text-gray-400 hover:text-white">Интеграции</a></li>--}}
{{--                        <li><a href="#" class="text-gray-400 hover:text-white">Безопасность</a></li>--}}
                    </ul>
                </div>

                <div class="w-1/4">
                    <h4 class="font-bold text-lg mb-4">Поддержка</h4>
                    <ul class="space-y-2">
{{--                        <li><a href="#" class="text-gray-400 hover:text-white">Помощь</a></li>--}}
                        <li><a href="#" class="text-gray-400 hover:text-white">Сообщество</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">База знаний</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Контакты</a></li>
                    </ul>
                </div>
                <div class="w-1/4">
                    <h4 class="font-bold text-lg mb-4">Компания</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">О нас</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Блог</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Вакансии</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Партнеры</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-gray-300 py-3">
            <div class="mx-auto container ">
                <div class="flex flex-col space-y-3  ">
                    <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row">
                        <div class="w-full sm:w-1/2 text-center items-center justify-center">
                            &copy; Все права защищены {{ date('Y') }}
                            <br/>
                            Тех поддержка: <a
                                class="text-blue-700 hover:underline"
                                href="mailto:support@php-cat.com">support@php-cat.com</a>
                        </div>
                        <div class="w-full sm:w-1/2 text-center items-center justify-center">
                            Создание сервиса <a href="https://php-cat.com"
                                                class="text-blue-600 hover:underline"
                                                target="_blank">php-cat.com</a>

{{--                            <br/>--}}
{{--                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>--}}
{{--                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>--}}
{{--                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>--}}
{{--                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>/--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
