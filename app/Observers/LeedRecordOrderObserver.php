<?php

namespace App\Observers;

use App\Http\Controllers\Logs2Controller;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\Logs2;
use App\Models\LeedRecordOrder;
use Illuminate\Support\Facades\Auth;

class LeedRecordOrderObserver
{
    /**
     * Handle the LeedRecord "created" event.
     */
    public function created(LeedRecordOrder $leedRecordOrder): void
    {
        Logs2Controller::add('Лид / Создана задача: ' . $leedRecordOrder->text, [
            'leed_record_id' => $leedRecordOrder->leed_record_id,
            'type' => 'tech'
        ]);
    }

    /**
     * Handle the LeedRecord "updated" event.
     */
    public function updated(LeedRecordOrder $i): void
    {
        if ($i->isDirty('status')) {
//            // Получение названия нового столбца
            $newStatus = $i->status; // Получаем новый столбец
//            $oldColumnId = $leedRecord->getOriginal('leed_column_id');

            Logs2Controller::add(
                'Лид / задача закрыта / изменился статус на: ' . $i->status . ' Комментарий: ' . $i->close_comment,
                [
                    'leed_record_id' => $i->leed_record_id,
                ]
            );
        }
    }

    /**
     * Handle the LeedRecord "deleted" event.
     */
    public function deleted(LeedRecord $leedRecord): void
    {
        //
    }

    /**
     * Handle the LeedRecord "restored" event.
     */
    public function restored(LeedRecord $leedRecord): void
    {
        //
    }

    /**
     * Handle the LeedRecord "force deleted" event.
     */
    public function forceDeleted(LeedRecord $leedRecord): void
    {
        //
    }
}
