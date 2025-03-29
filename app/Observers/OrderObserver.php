<?php

namespace App\Observers;

use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\Logs2;
use App\Models\Order;
use App\Models\OrderPaymentType;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{

    public function created(Order $order): void
    {
        // подготовка данных
        if (1 == 1) {
//            $order->updated_at = time();

            // следующий номер заказа
            if (empty($order->virtual_order_id)) {
                $maxVirtualOrderId = Order::select('virtual_order_id')->max('virtual_order_id');
                $order->virtual_order_id = $maxVirtualOrderId + 1;
            }


        }

        // подготовка данных заглушки для 1 версии
        if (1 == 1) {
        }
    }

    /**
     * Handle the LeedRecord "updated" event.
     */
    public function updated(Order $order): void
    {
//        if ($leedRecord->isDirty('leed_column_id')) {
//            // Получение названия нового столбца
//            $newColumn = $leedRecord->column()->first(); // Получаем новый столбец
//            $newColumnName = $newColumn->name ?? '??';
//
//            $oldColumnId = $leedRecord->getOriginal('leed_column_id');
//            $oldColumnName = LeedColumn::whereId($oldColumnId)->first()->name ?? '??';
//
//            try {
//                // Создание комментария
//                Logs2::create([
//                    'comment' => "Перемещён: {$oldColumnName} > {$newColumnName}",
////                    'added_at' => now(),
//                    'autor_id' => Auth::id(),
//                    'leed_record_id' => $leedRecord->id,
//                    'type' => 'tech',
//                    'created_at' => now(),
//                ]);
//            }catch (\Exception $ex ){
//                dd($ex);
//            }
//
//        }
    }

    /**
     * Handle the LeedRecord "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the LeedRecord "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the LeedRecord "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
