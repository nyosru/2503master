<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nyos\Msg;

class TelegramNotificationController extends Controller
{

    public static function sendMessageToBoardUsers($board_id, $message){
        $message = __FUNCTION__.'('.$board_id.') '.$message;
        Msg::sendTelegramm($message);
    }

    public function sendMessage($message,$to){
        Msg::sendTelegramm($message,$to);

        //        $message = $request->message;
//        $chat_id = $request->chat_id;
//        $token = $request->token;
//        $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$message;
//        $ch = curl_init();

    }
}
