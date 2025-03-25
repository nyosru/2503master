<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <title>{{ config('app.name', 'Процесс') }}</title>--}}
    <title>ПроцессМастер.рф</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
{{--    @vite([--}}
{{--//	'public/css/output.css',--}}
{{--	'resources/css/app.css',--}}
{{--	'resources/js/app.js'])--}}
    <link href="/css/output.css?v={{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet">

</head>
<body class="font-sans xtext-gray-900 xantialiased"
      style="background-position: left top; background-size: cover;  background-image: url('/img/suncloud.jpg');"
>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 xbg-gray-100">

    {{--            <div>--}}
    {{--                <a href="/" wire:navigate>--}}
    {{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
    {{--                </a>--}}
    {{--            </div>--}}

    <div class="flex flex-col lg:flex-row lg:w-[800px]
{{--    bg-gradient-to-l from-white to-orange-400/40--}}
    rounded-xl overflow-hidden
    lg:bg-[url('/img/balls.jpg')]
    lg:bg-cover
    lg:shadow
    "
            {{--         style="background-size: cover;  background-image: url('/img/balls.jpg');"--}}
    >
        <div class="hidden lg:block w-1/2 min-h-[550px]">
            {{--            <img src="/img/balls.jpg"/>--}}
        </div>
        <div class="w-full lg:w-1/2
{{--        sm:max-w-md mt-6 px-6 py-4--}}
        m-3 p-3
{{--        bg-white--}}
{{--        shadow-md--}}
{{--        overflow-hidden --}}
{{--        sm:rounded-lg--}}
flex flex-col sm:justify-center items-center
        ">
            <div class="bg-white px-4 py-2 rounded shadow">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(100568272, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/100568272" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
