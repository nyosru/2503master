<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/api/webhook', // Путь вашего вебхука
        '/api/webhook/tele2', // Путь вашего вебхука
        '/api/webhook/*', // Путь вашего вебхука
        '/webhook/*', // Путь вашего вебхука
        '/api/setWebhook', // Путь вашего вебхука
        '/setWebhook', // Путь вашего вебхука
        '/auth/telegram/callback2', // Путь вашего вебхука
        '/api/auth/telegram/callback2', // Путь вашего вебхука
        '/auth/telegram/callback', // Путь вашего вебхука
        '/api/auth/telegram/callback', // Путь вашего вебхука
    ];
}
