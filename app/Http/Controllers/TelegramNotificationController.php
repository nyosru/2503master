<?php

namespace App\Http\Controllers;

use App\Models\BoardFieldSetting;
use App\Models\LeedRecord;
use Illuminate\Http\Request;
use Nyos\Msg;

class TelegramNotificationController extends Controller
{

    public static function sendMessageToLeedUsers( LeedRecord $leed, $board_id, $message)
    {
        $message0 = '';
        $bfs = BoardFieldSetting::whereBoardId($board_id)
            ->where('in_telega_msg', 1)
            ->orderBy('sort_order', 'DESC')->get();
//        dd($bfs->toArray());
        foreach ($bfs as $bf) {
            if (!empty($leed->{$bf->field_name}))
                $message0 .= $leed->{$bf->field_name} . PHP_EOL;
        }
//        $message = __FUNCTION__ . '(' . $leed->id . ') ' . $message;
        $message0 .= route('leed.item', ['board_id' => $board_id, 'id' => $leed->id ]) .PHP_EOL;
        $message0 .= $message;
//        dd($message0);
        $send_to = LeedController::getAllUsersTelegram($leed->id);
        Msg::$admins_id = $send_to['data'];
        Msg::sendTelegramm($message0, null, 2, env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendMessage($message, $to)
    {
        Msg::sendTelegramm($message, $to);

        //        $message = $request->message;
//        $chat_id = $request->chat_id;
//        $token = $request->token;
//        $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$message;
//        $ch = curl_init();

    }
}
