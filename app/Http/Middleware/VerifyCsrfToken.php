<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/webhook', // Путь вашего вебхука
        '/webhook/*', // Путь вашего вебхука
        '/setWebhook', // Путь вашего вебхука
        '/auth/telegram/callback2', // Путь вашего вебхука
        '/auth/telegram/callback', // Путь вашего вебхука
    ];
}
