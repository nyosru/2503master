<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Регистрируем middleware с алиасом 'check.permission'
        $middleware->alias([
            'check.permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('macros:process-daily')->dailyAt('08:00');
    })
    ->withCommands([
        // Укажите пути к вашим командам или конкретные классы
        App\Console\Commands\ProcessDailyMacros::class,
        //Или, если хотите регистрировать целую папку с командами:
        //__DIR__.'/../app/Console/Commands',
    ])
        ->create();
