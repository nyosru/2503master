<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Service\DadataOrgController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;

use Laravel\Socialite\Facades\Socialite;
use Nyos\Msg;
use Telegram\Bot\Laravel\Facades\Telegram;


Route::post('/dadata/find-org', [DadataOrgController::class, 'findByInn'])->name('dadata.find-org');


Route::post('/webhook1', function () {

    $update = json_decode(file_get_contents('php://input'), true);

    Log::info('Telegram Webhook:', $update);
    $chatId = $update['message']['chat']['id'] ?? null;
    if (!empty($chatId)) {

        $l = '';
        foreach ($update as $k => $v) {
            $l .= PHP_EOL
                . PHP_EOL
                . $k . ': ' . $v . PHP_EOL;
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    $l .= '     ' . $k2 . ': ' . $v2 . PHP_EOL;
                }
            }
        }

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => 'origin: '
                . serialize($update)
                . PHP_EOL
                . PHP_EOL
                . $l

        ]);
    }

    if (isset($update['message'])) {

        $chatId = $update['message']['chat']['id'] ?? null;
        $text = $update['message']['text'] ?? '';

        $us = User::whereId($chatId)->get()->first();
        $phone = $us->phone_number;

        // Пример: отправка сообщения обратно (нужна библиотека Telegram SDK)
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Вы написали --: $text"
        ]);

        if ( empty($phone) || $text == '11') {

// Define the keyboard with the "Share Phone Number" button
            $keyboard = [
                'keyboard' => [
                    [
                        [
                            'text' => 'Отправить свой номер телефона',
                            'request_contact' => true
                        ]
                    ]
                ],
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ];

// Send the message with the keyboard
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Поделитесь вашим номером телефона'.PHP_EOL.'кнопка ниже ↓↓↓ (Share Phone Number)',
                'reply_markup' => json_encode($keyboard)
            ]);

        }


    }

    return response('ok', 200);

});
Route::post('/webhook2', [\App\Http\Controllers\TelegramController::class,'inWebhook']);

//Route::any('/webhook2', function () {
//    $update = json_decode(file_get_contents('php://input'), true);
////    \App\Http\Controllers\TelegramController::inMessage($update);
//
//    if (isset($update['message']['contact'])) {
//        $contact = $update['message']['contact'];
//
//        // Получение номера телефона и других данных
//        $phoneNumber = $contact['phone_number'];
//        $firstName = $contact['first_name'];
//        $userId = $contact['user_id'];
//
//        Msg::sendTelegramm('получены данные'
//            . PHP_EOL . $firstName
//            . PHP_EOL . $phoneNumber
//            . PHP_EOL . $userId
//            , null, 1);
//
//        // Сохранение номера в базе данных или выполнение другой логики
//        Log::info("Получен контакт: {$firstName}, номер: {$phoneNumber}");
//
//        // Ответ пользователю
//        Telegram::sendMessage([
//            'chat_id' => $update['message']['chat']['id'],
//            'text' => "Спасибо за ваш номер телефона!"
//        ]);
//    }
//
//
//    Log::info('Telegram Webhook:', $update);
//
//    if (isset($update['message'])) {
//
//        $chatId = $update['message']['chat']['id'] ?? null;
//        $text = $update['message']['text'] ?? '';
//
//        // Пример: отправка сообщения обратно (нужна библиотека Telegram SDK)
//        Telegram::sendMessage([
//            'chat_id' => $chatId,
//            'text' => "Вы написали ++ : $text"
//        ]);
//
//
//        if ($text == '11') {
//
//// Define the keyboard with the "Share Phone Number" button
//            $keyboard = [
//                'keyboard' => [
//                    [
//                        [
//                            'text' => 'Share Phone Number',
//                            'request_contact' => true
//                        ]
//                    ]
//                ],
//                'resize_keyboard' => true,
//                'one_time_keyboard' => true
//            ];
//
//// Send the message with the keyboard
//            Telegram::sendMessage([
//                'chat_id' => $chatId,
//                'text' => 'Поделитесь вашим номером телефона:',
//                'reply_markup' => json_encode($keyboard)
//            ]);
//
//        }
//
//    }
//
//    return response('ok', 200);
//
//})
////    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
//;

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


Route::get('/auth1111/telegram/callback', function (Request $request) {
    showMeTelegaMsg();
    return view('auth-telegram.callback1');
});



Route::post('/auth/telegram/callback2', function (Request $request) {

    showMeTelegaMsg(__FUNCTION__);

    $jsonData = $request->input('tgAuthResult'); // Получаем строку
    $data = json_decode(base64_decode($jsonData), true); // Декодируем данные
//dd($data);
    if (!$data) {
        return response()->json(['error' => 'Ошибка при разборе данных'], 400);
    }


// Делаем проверку (можно добавить проверку подписи Telegram)
    $user = \App\Models\User::updateOrCreate(
        ['telegram_id' => $data['id']],
        [
            'email' => $data['id'] . '@telegram.ru',
            'password' => bcrypt($data['id']),
            'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
            'username' => $data['username'] ?? null,
            'avatar' => $data['photo_url'] ?? null,
        ]
    );
//    showMeTelegaMsg( 'user: '. serialize($user->toArray()) );
// Авторизуем пользователя
//    Auth::login($user);

//    return redirect('/');
    return response()->json(['data' => $data, 'user' => $user->toArray() ], 200);
//    return response()->json(['data' => $data], 200);

})->name('telegram.callback2');


Route::get('/setWebhook', function () {
    showMeTelegaMsg();
    $response = Telegram::setWebhook([
//            'url' => 'https://your-domain.com/webhook'
//                'url' => env('APP_URL2') . '/api/webhook',
        'url' => env('APP_URL2') . '/api/webhook1',
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
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;

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


Route::post('/webhook/tele2', function () {
    return response()->json(['ok' => true]);
});


//require __DIR__ . '/telega.php';
