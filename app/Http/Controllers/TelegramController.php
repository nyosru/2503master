<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
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
