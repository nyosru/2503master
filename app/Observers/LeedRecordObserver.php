<?php

namespace App\Observers;

use App\Http\Controllers\Logs2Controller;
use App\Http\Controllers\TelegramNotificationController;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\Logs2;
use Illuminate\Support\Facades\Auth;
use Nyos\Msg;

class LeedRecordObserver
{
    /**
     * Handle the LeedRecord "created" event.
     */
    public function created(LeedRecord $leedRecord): void
    {

        try {
            Logs2Controller::add('Лид создан', [
                'leed_record_id' => $leedRecord->id,
                'type' => 'tech'
            ]);
        } catch (\Exception $ex) {
            dd($ex);
        }

    }

    /**
     * Handle the LeedRecord "updated" event.
     */
    public function updated(LeedRecord $leedRecord): void
    {
        if ($leedRecord->isDirty('leed_column_id')) {

            // Получение названия нового столбца
            $newColumn = $leedRecord->column()->first(); // Получаем новый столбец
            $newColumnName = $newColumn->name ?? '??';

            $oldColumnId = $leedRecord->getOriginal('leed_column_id');
            $oldColumnName = LeedColumn::whereId($oldColumnId)->first()->name ?? '??';

            Logs2Controller::add('перемещён: ' . $oldColumnName . ' > ' . $newColumnName, [
                'leed_record_id' => $leedRecord->id,
                'type' => 'tech'
            ]);
//            dd($leedRecord->toArray());


            try {
                TelegramNotificationController::sendMessageToLeedUsers($leedRecord, $newColumn->board_id, 'Обьект перемещён:' . $oldColumnName . ' > ' . $newColumnName);
            } catch (\Exception $ex) {
                Msg::sendTelegramm('error:' . __FILE__ . ' ' . __LINE__ . '/' . $ex->getMessage());
            }

        }
    }

//    /**
//     * Handle the LeedRecord "deleted" event.
//     */
//    public function deleted(LeedRecord $leedRecord): void
//    {
//        //
//    }
//
//    /**
//     * Handle the LeedRecord "restored" event.
//     */
//    public function restored(LeedRecord $leedRecord): void
//    {
//        //
//    }
//
//    /**
//     * Handle the LeedRecord "force deleted" event.
//     */
//    public function forceDeleted(LeedRecord $leedRecord): void
//    {
//        //
//    }
}
