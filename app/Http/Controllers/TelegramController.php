<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;


class TelegramController extends Controller
{
    public static function inMessage($update){

        Log::info('Telegram Webhook:', $update);

        $chatId = $update['message']['chat']['id'] ?? null;
        if (!empty($chatId)) {

            $l = '';
            foreach ($update as $k => $v) {
                $l .= PHP_EOL
                    .PHP_EOL
                    .$k . ': ' . $v . PHP_EOL ;
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
