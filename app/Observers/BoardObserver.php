<?php

namespace App\Observers;

use App\Models\Board;
use App\Models\Logs2;
use Illuminate\Support\Facades\Auth;

class BoardObserver
{
    /**
     * Handle the Board "created" event.
     */
    public function created(Board $board): void
    {
        $newName = $board->name;

        Logs2::create([
            'comment' => 'Создана новая доска: '.$newName,
            'type' => 'board_created',
            'user_id' => Auth::id() ?? null, // ID пользователя, если авторизован
            'board_id' => $board->id,
//            'data' => json_encode([
//                'board_id' => $board->id,
//                'new_name' => $newName,
//                'changed_at' => now()->toDateTimeString(),
//            ]),
        ]);
    }

    /**
     * Handle the Board "updated" event.
     */
    public function updated(Board $board): void
    {
        // Проверяем, изменилось ли поле name
        if ($board->isDirty('name')) {
            $oldName = $board->getOriginal('name');
            $newName = $board->name;

            Logs2::create([
                'comment' => "Изменено название доски: с '{$oldName}' на '{$newName}'",
                'type' => 'board_name_changed',
                'user_id' => Auth::id() ?? null, // ID пользователя, если авторизован
                'board_id' => $board->id,
                'data' => json_encode([
                    'board_id' => $board->id,
                    'old_name' => $oldName,
                    'new_name' => $newName,
                    'changed_at' => now()->toDateTimeString(),
                ]),
            ]);
        }
    }

    /**
     * Handle the Board "deleted" event.
     */
    public function deleted(Board $board): void
    {
        $newName = $board->name;

        Logs2::create([
            'comment' => 'доска удалена: '.$newName,
            'type' => 'board_deleted',
            'user_id' => Auth::id() ?? null, // ID пользователя, если авторизован
            'board_id' => $board->id,
//            'data' => json_encode([
//                'board_id' => $board->id,
//                'new_name' => $newName,
//                'changed_at' => now()->toDateTimeString(),
//            ]),
        ]);
    }

    /**
     * Handle the Board "restored" event.
     */
    public function restored(Board $board): void
    {
        //
    }

    /**
     * Handle the Board "force deleted" event.
     */
    public function forceDeleted(Board $board): void
    {
        //
    }
}
