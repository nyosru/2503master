<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nyos\Msg;

class TelegramNotificationController extends Controller
{
    public function sendMessage($message,$to){

        Msg::sendTelegramm($message,$to);

        //        $message = $request->message;
//        $chat_id = $request->chat_id;
//        $token = $request->token;
//        $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$message;
//        $ch = curl_init();

    }
}
