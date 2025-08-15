<?php

namespace App\Observers;


use App\Http\Controllers\TelegramNotificationController;
use App\Models\User;
use Nyos\Msg;

class UserObserver
{
    public function created(User $user)
    {

        Msg::sendTelegramm('🐹🐹🐹 новая рега: '.$user->login.' '.$user->name.' '.$user->email);

        // Отправить оповещение о регистрации
//        try {
//            TelegramNotificationController::sendMessage($leedRecord, $newColumn->board_id, 'Обьект перемещён:' . $oldColumnName . ' > ' . $newColumnName);
//        } catch (\Exception $ex) {
//            Msg::sendTelegramm('error:' . __FILE__ . ' ' . __LINE__ . '/' . $ex->getMessage());
//        }

    }
}
