<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TelegramController extends Controller
{
    public function redirect()
    {
        $botToken = config('services.telegram.bot_token');
        $redirectUrl = url('/auth/telegram/callback2');

        $telegramAuthUrl = "https://oauth.telegram.org/auth?bot_id=" . explode(':', $botToken)[0] . "&origin=" . urlencode($redirectUrl);

        return redirect($telegramAuthUrl);
    }

    public function callback()
    {
        $data = request()->all();

        if (!isset($data['hash'])) {
            return redirect('/')->with('error', 'Ошибка авторизации через Telegram');
        }

        // Проверяем подпись данных
        $checkHash = $data['hash'];
        unset($data['hash']);

        $dataCheckArr = [];
        foreach ($data as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }

        sort($dataCheckArr);
        $dataCheckString = implode("\n", $dataCheckArr);
        $secretKey = hash('sha256', config('services.telegram.bot_token'), true);
        $hash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if ($hash !== $checkHash) {
            return redirect('/')->with('error', 'Неверная подпись данных');
        }

        // Проверяем время жизни данных (не старше 24 часов)
        if (time() - $data['auth_date'] > 86400) {
            return redirect('/')->with('error', 'Данные авторизации устарели');
        }

        // Ищем или создаем пользователя
        $user = User::where('telegram_id', $data['id'])->first();

        if (!$user) {
            // Создаем нового пользователя
            $user = User::create([
                'telegram_id' => $data['id'],
                'name' => $data['first_name'] . (isset($data['last_name']) ? ' ' . $data['last_name'] : ''),
                'username' => $data['username'] ?? 'tg_user_' . $data['id'],
                'email' => 'telegram_' . $data['id'] . '@example.com', // Заглушка для email
                'password' => bcrypt(Str::random(16)),
                'avatar' => $data['photo_url'] ?? null,
            ]);
        }

        // Авторизуем пользователя
        Auth::login($user, true);

        // Перенаправляем на страницу после успешной авторизации
        return redirect('/dashboard')->with('success', 'Добро пожаловать!');
    }
}
