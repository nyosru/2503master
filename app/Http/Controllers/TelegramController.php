<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Nyos\Msg;


class TelegramController extends Controller
{

    public static function showMeTelegaMsg($msg = '')
    {
        $update = json_decode(file_get_contents('php://input'), true);

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $caller = $backtrace[0];

        Msg::sendTelegramm('телега тест №' . __LINE__
            . PHP_EOL
            . 'Файл: ' . ($caller['file'] ?? 'x')
            . PHP_EOL
            . 'Строка: ' . ($caller['line'] ?? 'x')
            . PHP_EOL
            . 'fn: ' . ($caller['function'] ?? 'x')
            . PHP_EOL
            . 'msg: ' . ($msg ?? 'x')
            . PHP_EOL
            . serialize($update)
            , null, 1);
    }


    public function callbackOrigin(request $request){
        dd($request->all());
    }


    public function callbackStart(request $request)
    {
        self::showMeTelegaMsg();
//dd($request->id);
        if (!empty($request->id))
            $this->callback($request);

        return view('auth-telegram.callback1');
    }

    public function callback(request $request)
    {

        self::showMeTelegaMsg(__FUNCTION__);

        if (!empty($request->id)) {
            $data = $request;
        } else {
            $jsonData = $request->input('tgAuthResult'); // Получаем строку
            $data = json_decode(base64_decode($jsonData), true); // Декодируем данные
//dd($data);
            if (!$data) {
                return response()->json(['error' => 'Ошибка при разборе данных'], 400);
            }
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
        Auth::login($user);

        dd(__LINE__);


//        if (!empty($request->id)) {
//            return redirect('/');
//        }
//    return redirect(route('leeds.index'));
        return response()->json(['data' => $data, 'user_id' => $user->id], 200);
//    return response()->json(['data' => $data['id']], 200);
//    return response()->json(['data' => $data], 200);

    }


    public static function inMessage($update)
    {

        Log::info('Telegram Webhook:', $update);

        $chatId = $update['message']['chat']['id'] ?? null;
        if (!empty($chatId)) {

            $l = '';
            foreach ($update as $k => $v) {
                $l .= PHP_EOL
                    . PHP_EOL
                    . $k . ': '
                    . $v . PHP_EOL;

//                if (is_array($v)) {
//                    foreach ($v as $k2 => $v2) {
//                        $l .= '     ' . $k2 . ': ' . $v2 . PHP_EOL ;
//                    }
//                }

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


    }


    public function inWebhook(Request $request)
    {

        $update = json_decode(file_get_contents('php://input'), true);

//    \App\Http\Controllers\TelegramController::inMessage($update);


        // если отправили телеф номер, то получить его и сохранить в бд
        if (isset($update['message']['contact'])) {
            $this->getRequestPhone($update);
        }


        Log::info('Telegram Webhook:', $update);

        if (isset($update['message'])) {

            $chatId = $update['message']['chat']['id'] ?? null;
            $text = $update['message']['text'] ?? '';

            // Пример: отправка сообщения обратно (нужна библиотека Telegram SDK)
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Вы написали ++ : $text"
            ]);

// показ кнопки "отправить контакт"
            if (
                $text == '11'
                || $text == '/start'
            ) {
                $this->sendRequestPhone($chatId);
            }

        }

        return response('ok', 200);

    }


    public function getRequestPhone($update)
    {
        $contact = $update['message']['contact'];

        // Получение номера телефона и других данных
        $phoneNumber = $contact['phone_number'];
        $firstName = $contact['first_name'];
        $userId = $contact['user_id'];

        UserController::setPhoneNumberFromTelegaId($userId, $phoneNumber);

        Msg::sendTelegramm('получены данные'
            . PHP_EOL . $firstName
            . PHP_EOL . $phoneNumber
            . PHP_EOL . $userId
            . PHP_EOL . 'chat_id:' . $update['message']['chat']['id']
//            . PHP_EOL . '$user_status:' . serialize($user_status->id ?? '')
            , null, 1);

        // Сохранение номера в базе данных или выполнение другой логики
        Log::info("Получен контакт: {$firstName}, номер: {$phoneNumber}");

        // Ответ пользователю
        Telegram::sendMessage([
            'chat_id' => $update['message']['chat']['id'],
            'text' => "Спасибо за ваш номер телефона!"
        ]);

    }


    public function sendRequestPhone($chatId)
    {

// Define the keyboard with the "Share Phone Number" button
        $keyboard = [
            'keyboard' => [
                [
                    [
                        'text' => 'Share Phone Number',
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
            'text' => 'Поделитесь вашим номером телефона:',
            'reply_markup' => json_encode($keyboard)
        ]);

    }


    public function handleWebhook(Request $request)
    {
        $update = Telegram::getWebhookUpdate();

        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'];

            // Ответ пользователю
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Вы отправили: {$text}"
            ]);
        }

        return response('ok', 200);
    }
}
