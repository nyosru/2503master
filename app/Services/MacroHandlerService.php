<?php

namespace App\Services;

use App\Models\LeedRecord;
use App\Models\Macros;
class MacroHandlerService
{
    public function execute(Macros $macro)
    {
        return match ($macro->type) {
            'telegram_message' => $this->sendTelegramMessage($macro),
            'status_change' => $this->changeStatus($macro),
            'reminder' => $this->createReminder($macro),
            default => throw new \Exception("Unknown macro type: {$macro->type}"),
        };
    }

    private function sendTelegramMessage(Macros $macro)
    {
        // Пример: отправка в Telegram
        $telegrams = explode(',', $macro->to_telegrams);

        foreach ($telegrams as $chatId) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $macro->message,
            ]);
        }
    }

    private function changeStatus(Macros $macro)
    {
        // Пример изменения статуса лида
        if ($macro->leed_id) {
            $leed = LeedRecord::find($macro->leed_id);
            $leed->update(['status' => $macro->param1]);
        }
    }

    private function createReminder(Macros $macro)
    {
        // Пример создания напоминания
        Reminder::create([
            'leed_id' => $macro->leed_id,
            'days' => $macro->day,
            'message' => $macro->message,
        ]);
    }
}
