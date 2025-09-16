<?php

namespace App\Observers;


use App\Http\Controllers\TelegramNotificationController;
use App\Http\Controllers\VkMessageController;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Nyos\Msg;

class UserObserver
{
    public function created(User $user)
    {

        // Проверяем, что это новая регистрация (не через seed и т.д.)
        if (!$this->isFromSeeder() && !$this->isFromConsole()) {

            Msg::sendTelegramm(
                '🐹🐹🐹 новая рега: '.$user->login.' '.$user->name.' '.$user->login
                .' https://vk.com/id'.( $user->vk_id ?? '' ).' ');
//            $this->sendNewUserNotification($user);

        }

        // Отправить оповещение о регистрации
//        try {
//            TelegramNotificationController::sendMessage($leedRecord, $newColumn->board_id, 'Обьект перемещён:' . $oldColumnName . ' > ' . $newColumnName);
//        } catch (\Exception $ex) {
//            Msg::sendTelegramm('error:' . __FILE__ . ' ' . __LINE__ . '/' . $ex->getMessage());
//        }

    }



    /**
     * Отправка уведомления о новом пользователе
     */
    protected function sendNewUserNotification(User $user)
    {
        try {
            $vkAdminId = env('VK_ADMIN_ID', 5903492);

            if (empty($vkAdminId)) {
                Log::warning('VK_ADMIN_ID not set');
                return;
            }

            $message = $this->formatNewUserMessage($user);

            $vkController = new VkMessageController();

            // Пытаемся отправить от имени приложения
            $success = $vkController->sendFromApp($vkAdminId, $message);

            if (!$success) {
                Log::warning('Failed to send VK notification from app, trying alternative methods');
                // Можно добавить fallback методы здесь
            }

            Log::info('New user notification sent to admin', [
                'user_id' => $user->id,
                'vk_admin_id' => $vkAdminId
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send new user notification', [
                'error' => $e->getMessage(),
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * Форматирование сообщения о новом пользователе
     */
    protected function formatNewUserMessage(User $user): string
    {
        $message = "🎉 Новый пользователь зарегистрировался!\n\n";
        $message .= "👤 Имя: {$user->name}\n";

        if ($user->email) {
            $message .= "📧 Email: {$user->email}\n";
        }

        if ($user->vk_id) {
            $message .= "🔗 VK ID: {$user->vk_id}\n";
            $message .= "🔗 VK профиль: https://vk.com/id{$user->vk_id}\n";
        }

        $message .= "🕐 Дата регистрации: " . $user->created_at->format('d.m.Y H:i') . "\n";
        $message .= "🆔 ID в системе: {$user->id}";

        return $message;
    }

    /**
     * Проверяем, что создание не из сидера
     */
    protected function isFromSeeder(): bool
    {
        return app()->runningInConsole() && preg_match('/seed/i', implode(' ', $_SERVER['argv']));
    }

    /**
     * Проверяем, что не из консоли (кроме определенных команд)
     */
    protected function isFromConsole(): bool
    {
        $consoleCommands = ['migrate', 'artisan', 'schedule:run'];
        $currentCommand = implode(' ', $_SERVER['argv'] ?? []);

        return app()->runningInConsole() &&
            !preg_match('/(' . implode('|', $consoleCommands) . ')/i', $currentCommand);
    }


}
