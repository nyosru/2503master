<?php

namespace App\Observers;

use App\Http\Controllers\Logs2Controller;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\LeedRecordComment;
use App\Models\Logs2;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class LeedRecordCommentObserver
{


    /**
     * Handle the LeedRecord "created" event.
     */
    public function created(LeedRecordComment $i): void
    {
        try {
            Logs2Controller::add('Лид + комментарий создан / ' . $i->comment, [
                'leed_record_id' => $i->leed_record_id,
//                'type' => 'tech'
            ]);

            if (1 == 2) {
                try {
                    if ($i->leed->user_id !== $i->user_id && !empty($i->leed->user->staff->telegram_chat_id)) {
                        Telegram::sendMessage([
//                        'chat_id' => env('TELEGRAM_CHAT_ID'), // ID чата, куда будут отправляться сообщения
                            'chat_id' => $i->leed->user->staff->telegram_chat_id, // ID чата, куда будут отправляться сообщения
                            'text' => ' Лид + новый комментарий'
                                . PHP_EOL . 'Лид: ' . (($i->leed) ? $i->leed->name : 'xx' . $i->leed_record_id)
                                . PHP_EOL . ' https://cms2.dev.marudi.store/leed/' . $i->leed_record_id
//                            . PHP_EOL . 'Автор: ' . (($i->user->staff) ? $i->user->staff->name : 'xx')
                                . PHP_EOL . 'Автор: ' . ($i->user->name ?? 'xx')
                                . PHP_EOL . 'Комментарий:' . $i->comment,
//                    'parse_mode' => 'Markdown',
                        ]);
                    }
                } catch (\Exception $e) {
                    // Обработка ошибок
                    \Log::error($e->getMessage());
                }
            }
        } catch (\Exception $ex) {
//            dd($ex);
        }
    }

    /**
     * Handle the LeedRecord "updated" event.
     */
    public function updated(LeedRecordComment $i): void
    {
//        if ($leedRecord->isDirty('leed_column_id')) {
//
//            // Получение названия нового столбца
//            $newColumn = $leedRecord->column()->first(); // Получаем новый столбец
//            $newColumnName = $newColumn->name ?? '??';
//
//            $oldColumnId = $leedRecord->getOriginal('leed_column_id');
//            $oldColumnName = LeedColumn::whereId($oldColumnId)->first()->name ?? '??';
//
//            Logs2Controller::add('Лид перемещён: '.$oldColumnName.' > '.$newColumnName,[
//                'leed_record_id' => $leedRecord->id,
//                'type' => 'tech'
//            ]);
//
////
////            try {
////                // Создание комментария
////                Logs2::create([
////                    'comment' => "Перемещён: {$oldColumnName} > {$newColumnName}",
//////                    'added_at' => now(),
////                    'user_id' => Auth::id(),
////                    'leed_record_id' => $leedRecord->id,
////                    'type' => 'tech',
////                    'created_at' => now(),
////                ]);
////
////
////            }catch (\Exception $ex ){
////                dd($ex);
////            }
//
//        }
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
