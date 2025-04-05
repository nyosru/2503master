<?php

use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Nyos\Msg;
use Telegram\Bot\Laravel\Facades\Telegram;




function checkTelegramAuthorization($data)
{
    $botToken = env('TELEGRAM_BOT_TOKEN');

    showMeTelegaMsg();

    if (!isset($data['hash']) || empty($botToken)) {
        return false;
    }

    $check_hash = $data['hash'];
    unset($data['hash']);
    $data_check_arr = [];
    foreach ($data as $key => $value) {
        $data_check_arr[] = $key . '=' . $value;
    }
    sort($data_check_arr);
    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash('sha256', $botToken, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);


    Msg::sendTelegramm('проверка телеги'
        . PHP_EOL . $botToken
        . PHP_EOL . $hash
        . PHP_EOL . $check_hash

        , null, 1);

    if (strcmp($hash, $check_hash) !== 0) {
        throw new Exception('Data is NOT from Telegram');
    }
    if ((time() - $data['auth_date']) > 86400) {
        throw new Exception('Data is outdated');
    }
    return $data;
}

function showMeTelegaMsg()
{
    $update = json_decode(file_get_contents('php://input'), true);

    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
    $caller = $backtrace[0];

    Msg::sendTelegramm('телега тест №' . __LINE__
        . PHP_EOL
        . 'Файл: ' . $caller['file']
        . PHP_EOL
        . 'Строка: ' . $caller['line']
        . PHP_EOL
        . serialize($update)
        , null, 1);
}


function verifyTelegramAuth(array $data): bool
{
    $botToken = env('TELEGRAM_BOT_TOKEN');

    if (!isset($data['hash']) || empty($botToken)) {
        return false;
    }

    $hash = $data['hash'];
    unset($data['hash']); // Убираем хеш перед вычислением

    sort($data); // Сортируем ключи по алфавиту
    $dataCheckString = [];
    foreach ($data as $key => $value) {
        $dataCheckString[] = $key . '=' . $value;
//            $dataCheckString[] = "{$key}={$value}";
    }
    $dataCheckString = implode("\n", $dataCheckString); // Объединяем строки

    // 🔑 Формируем секретный ключ
    $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);

    // 🔐 Вычисляем ожидаемый hash
    $expectedHash = hash_hmac('sha256', $dataCheckString, $secretKey);


    Msg::sendTelegramm('проверка телеги'
        . PHP_EOL . $botToken
        . PHP_EOL . $hash
        . PHP_EOL . $expectedHash

        . PHP_EOL . '📌 auth_date: '
        . PHP_EOL . 'received: ' . ($data['auth_date'] ?? '❌ Нет auth_date')
        . PHP_EOL . 'current_time: ' . time()
        . PHP_EOL . 'time_diff: ' . (isset($data['auth_date']) ? time() - $data['auth_date'] : '❌')

        , null, 1);

    return hash_equals($expectedHash, $hash);
}



Route::get('/auth/telegram/callback', function (Request $request) {
    showMeTelegaMsg();
    return view('auth-telegram.callback1');
});

Route::post('/auth/telegram/callback2', function (Request $request) {

    showMeTelegaMsg();

    $jsonData = $request->input('tgAuthResult'); // Получаем строку
    $data = json_decode(base64_decode($jsonData), true); // Декодируем данные
//dd($data);
    if (!$data) {
        return response()->json(['error' => 'Ошибка при разборе данных'], 400);
    }
    return response()->json(['data' => $data], 200);
})->name('telegram.callback2');

Route::get('/setWebhook', function () {
    showMeTelegaMsg();
    $response = Telegram::setWebhook([
//            'url' => 'https://your-domain.com/webhook'
        'url' => env('APP_URL2') . '/webhook',
    ]);

    return $response ? 'Webhook установлен' : 'Ошибка установки вебхука';
});


Route::post('/webhook', function () {
    $update = json_decode(file_get_contents('php://input'), true);

    if (isset($update['message'])) {
        $message = $update['message'];
        $text = $message['text'];
        $chatId = $message['chat']['id'];

        // Обработка сообщения
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Вы написали: $text"
        ]);
    }

    showMeTelegaMsg();

    return response('ok', 200);
});

Route::post('/webhook/tele2', function () {
    $update = json_decode(file_get_contents('php://input'), true);

    if (isset($update['message'])) {
        $message = $update['message'];
        $text = $message['text'];
        $chatId = $message['chat']['id'];

        // Обработка сообщения
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Вы написали: $text"
        ]);
    }

    showMeTelegaMsg();

    return response('ok', 200);
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


//Route::post('/webhook', function () {
Route::any('/webhook', function () {

    showMeTelegaMsg();

    $update = Telegram::getWebhookUpdate();

    // Обработка входящего сообщения
    if (isset($update['message'])) {
        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = $message['text'];

        // Ответ пользователю
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Вы отправили: $text"
        ]);
    }

    return response('ok', 200);
//    return response()->json(['ok'], 200);

})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);



////    $update = file_get_contents('php://input');
////    showMeTelegaMsg();
//////        \Log::info("Получен запрос от Telegram: " . $update);
////
////    return response('ok', 200);
//});
//
//
////    // Проверяем подпись Telegram
////    $hash = $data['hash'];
////    unset($data['hash']);
////    $dataCheckString = '';
////    foreach ($data as $key => $value) {
////        $dataCheckString .= $key . '=' . $value . "\n";
////    }
////    $secretKey = hash('sha256', env('TELEGRAM_BOT_TOKEN'), true);
////    $expectedHash = hash_hmac('sha256', $dataCheckString, $secretKey);
////    if (!hash_equals($expectedHash, $hash)) {
////        return response()->json(['error' => 'Неверная подпись'], 400);
//////        return response()->json(['error' => 'Неверная подпись'], 400);
////    }
//// Проверка подписи (hash)
////    if (!verifyTelegramAuth($data)) {
////        return response()->json(['error' => 'Неверная подпись Telegram'], 400);
////    }
//try {
//    $ee = checkTelegramAuthorization($data);
//} catch (Exception $e) {
//    return response()->json(['error' => 'Неверная подпись Telegram'], 400);
//}
//
//Log::info('Telegram login data:', $data); // Логируем для проверки
//
//// Делаем проверку (можно добавить проверку подписи Telegram)
//$user = \App\Models\User::updateOrCreate(
//    ['telegram_id' => $data['id']],
//    [
//        'email' => $data['id'] . '@telegram.ru',
//        'password' => bcrypt($data['id']),
//        'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
//        'username' => $data['username'] ?? null,
//        'avatar' => $data['photo_url'] ?? null,
//    ]
//);
//
//// Авторизуем пользователя
//Auth::login($user);
//
//return response()->json(['message' => 'Успешный вход!', 'user' => $user]);
//
////    $telegramData = $request->all(); // Получаем данные от Telegram
////    // Проверка данных и аутентификация пользователя
////    dd($telegramData);
//});

//Route::get('/auth/telegram', function () {
//    return Socialite::driver('telegram')->redirect();
//});
//
//Route::get('/auth/telegram/callback', function () {
//    $telegramUser = Socialite::driver('telegram')->user();
//
//    // Найти пользователя по Telegram ID или создать нового
//    $user = User::updateOrCreate([
//        'telegram_id' => $telegramUser->getId(),
//    ], [
//        'name' => $telegramUser->getName(),
//        'email' => $telegramUser->getEmail(), // Telegram не всегда передаёт email
//        'password' => bcrypt(str()->random(16)), // Генерируем случайный пароль
//    ]);
//
//    Auth::login($user);
//
//    return redirect('/dashboard'); // Перенаправление после входа
//});

