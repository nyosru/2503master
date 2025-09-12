<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание записи</title>
    {{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    <link href="/css/output.css?v={{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

<div class="container mx-auto py-8 min-h-[80vh]">
    {{ $slot }}
</div>

<!-- Простой футер -->
<footer class="bg-white mt-2 py-2 border-t">
    <div class="container mx-auto px-4 text-center text-gray-600">
        {{--        &copy; {{ date('Y') }}--}}
    </div>
</footer>

</body>

</html>
