<?php

namespace App\Http\Controllers;

use App\Models\LeedNotification;
use App\Models\LeedNotificationLog;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function startJob()
    {
//        $e = LeedNotification::with(['logs'])->get();

        $notifications = LeedNotification::whereNotNull('once_at')
//            ->whereHas('leed.column.board.boardUsers', function ($query) {
//                $query
////                    ->whereColumn('board_users.role_id', 'leed_notifications.position_id')
////                    ->where('board_users.role_id', 'leed_notifications.position_id')
////                    ->whereRoleId('leed_notifications.position_id')
////                    ->where('board_users.board_id', $boardId)
//                    ->where('board_users.deleted', false)
//                ;
//            })
            ->with([
//                'leed',
//                'leed.column',
//                'leed.column.board',
                'leed.column.board.boardUsers' => function ($query) {
                    $query->where('deleted', false);
//                                            ->whereColumn('board_users.role_id', 'leed_notifications.position_id')
//                                            ->whereRoleId('leed_notifications.position_id')
                    ;
//                    $query->where( 'board_users.role_id', '=', 'roles.id' );
                    $query->with([
//                        'role',
                        'user'
                    ]);
                },
//                'leed.column.board.boardUsers.user' => function ($query) {
////                    $query->select( 'id', 'name', 'telegram_id', 'phone_number' );
//                },
                'user',
//                'position'
            ])
            ->doesntHave('logs')  // 'logs' - это имя отношения в модели LeedNotification
            ->get();

        $start = microtime(true); // Более точное время начала

        foreach ($notifications as $item) {
            echo $item->id . '<Br/>';

            $go = $this->checkNotificateToRun($item);

            if ($go) {
                echo 'го го ' . __LINE__ . '<br/>';
                $a = $this->run($item);
            }

            $end1 = microtime(true); // Время окончания
            $result1 = $end1 - $start; // Разница в секундах

            if ($result1 > 3) {
                echo 'ss' . __LINE__ . '<br/>';
                break;
            }
        }

        $end = microtime(true); // Время окончания
        $result = $end - $start; // Разница в секундах

        echo "Время выполнения: " . number_format($result, 4) . " секунд";

        dd($notifications->toArray());
    }


    public function getAdresates(LeedNotification $notification): array
    {

        $telegrams = [];

//        position_id
//        user_id
        if (!empty($notification->user_id)) {

            if( !empty( $notification->user->telegram_id ) ){
                $telegrams[] = $notification->user->telegram_id;
            };
        }
        else if (!empty($notification->position_id)) {
            foreach ($notification->leed->column->board->boardUsers as $boardUser) {
                if ($notification->position_id == $boardUser->role_id) {
//                    echo '-++ ' . $boardUser->role_id . '<br/>';
//                    echo '-++ ' . $boardUser->user->name . '<br/>';
//                    echo '-++ telegram_id:' . $boardUser->user->telegram_id . '<br/>';
//                    $telegrams[$boardUser->user->telegram_id] = $boardUser->user->toArray();
                    $telegrams[] = $boardUser->user->telegram_id;
                }
            }
        }

        return array_unique($telegrams);

//        echo '<pre>',print_r($notification->user()),'</pre>';
//        echo '<pre style="max-height: 200px; overflow: auto; border: 2px solid green;">', print_r($notification->toArray()), '</pre>';

    }


    public function run(LeedNotification $notification)
    {

//        $new = LeedNotificationLog::create([
//            'leed_notification_id' => $note->id,
//            'started_at' => now(),
//        ]);

        $telegrams = $this->getAdresates($notification);
dump($telegrams);
//        sleep(1);

//        $new->update([
//            'finished_at' => now(),
//        ]);

//        $e = LeedNotification::with(['logs'])->get();
//        dd($e->toArray());
    }


    /**
     * проверяем запускать или нет
     * @param LeedNotification $notification
     * @return void
     */
    public function checkNotificateToRun(LeedNotification $notification): bool
    {

        if (!empty($notification->once_at)) {

            if ($notification->once_at <= now()) {
                echo '-- сработало, делай -- ' . __LINE__ . '<br/>';
                return true;
            } else {
                echo '-- не сработало -- ' . __LINE__ . '<br/>';
                return false;
            }

        }

        return false;

//            if( $notification->once_at <= now() ){
//                echo __LINE__.'<br/>';
//            }
//            else
//            {
//                echo __LINE__.'<br/>';
//            }
//        }

    }


    public function store(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'leed_order_id' => 'nullable|exists:leed_record_orders,id',
            'reminder_date' => 'nullable|date',
            'reminder_time' => 'nullable|date_format:H:i',
            'remind_in_telegram' => 'boolean',
        ]);

        // Создание DTO
        $notificationDTO = new NotificationDTO($validatedData);

        // Создание новой записи Notification
        $notification = Notification::create([
            'title' => $notificationDTO->title,
            'user_id' => $notificationDTO->user_id,
            'leed_order_id' => $notificationDTO->leed_order_id,
            'reminder_date' => $notificationDTO->reminder_date,
            'reminder_time' => $notificationDTO->reminder_time,
            'remind_in_telegram' => $notificationDTO->remind_in_telegram,
        ]);

        return response()->json($notification, 201);
    }
}
