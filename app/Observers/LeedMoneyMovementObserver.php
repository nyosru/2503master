<?php

namespace App\Observers;

use App\Models\LeedMoneyMovement;
use App\Models\Logs2;

class LeedMoneyMovementObserver
{
    /**
     * Handle the LeedMoneyMovement "created" event.
     */
    public function created(LeedMoneyMovement $movement): void
    {
        Logs2::create([
            'leed_record_id' => $movement->leed_record_id,
            'user_id'        => $movement->user_id,

            'type' => 'money_movement',
            'comment' => 'Добавлена запись о движении денег / '.$movement->amount.' '.($movement->comment ?? ''),

        ]);
    }

    /**
     * Handle the LeedMoneyMovement "updated" event.
     */
//    public function updated(LeedMoneyMovement $movement): void
//    {
//        //
//    }

    /**
     * Handle the LeedMoneyMovement "deleted" event.
     */
    public function deleted(LeedMoneyMovement $movement): void
    {
        Logs2::create([
            'leed_record_id' => $movement->leed_record_id,
            'user_id'        => $movement->user_id,
            'type' => 'money_movement',
            'comment' => 'Удалена запись о движении денег / '.$movement->amount.' '.($movement->comment ?? ''),

        ]);
    }

    /**
     * Handle the LeedMoneyMovement "restored" event.
     */
//    public function restored(LeedMoneyMovement $leedMoneyMovement): void
//    {
//        //
//    }

    /**
     * Handle the LeedMoneyMovement "force deleted" event.
     */
//    public function forceDeleted(LeedMoneyMovement $leedMoneyMovement): void
//    {
//        //
//    }
}
