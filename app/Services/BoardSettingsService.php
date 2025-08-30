<?php

namespace App\Services;

use App\Models\BoardUserSetting;


/*
6. Пример использования
php

// В контроллере или сервисе
use App\Services\BoardSettingsService;

$settingsService = new BoardSettingsService();

// Установка числовой настройки
$settingsService->setNumericSetting($boardId, $userId, 'column_width', 300);

// Установка строковой настройки
$settingsService->setStringSetting($boardId, $userId, 'theme', 'dark');

// Получение настройки
$columnWidth = $settingsService->getSetting($boardId, $userId, 'column_width', 250);
$theme = $settingsService->getSetting($boardId, $userId, 'theme', 'light');

// Удаление настройки
$settingsService->removeSetting($boardId, $userId, 'column_width');
 */






class BoardSettingsService
{
    /**
     * Получить значение настройки для пользователя и доски
     */
    public function getSetting(int $boardId, int $userId, string $setting, $default = null)
    {
        $settingModel = BoardUserSetting::forBoardAndUser($boardId, $userId)
            ->forSetting($setting)
            ->first();

        return $settingModel ? $settingModel->getValue() : $default;
    }

    /**
     * Установить числовое значение настройки
     */
    public function setNumericSetting(int $boardId, int $userId, string $setting, ?int $value): BoardUserSetting
    {
        return BoardUserSetting::updateOrCreate(
            [
                'board_id' => $boardId,
                'user_id' => $userId,
                'setting' => $setting,
            ],
            [
                'numeric_value' => $value,
                'string_value' => null,
            ]
        );
    }

    /**
     * Установить строковое значение настройки
     */
    public function setStringSetting(int $boardId, int $userId, string $setting, ?string $value): BoardUserSetting
    {
        return BoardUserSetting::updateOrCreate(
            [
                'board_id' => $boardId,
                'user_id' => $userId,
                'setting' => $setting,
            ],
            [
                'string_value' => $value,
                'numeric_value' => null,
            ]
        );
    }

    /**
     * Удалить настройку
     */
    public function removeSetting(int $boardId, int $userId, string $setting): bool
    {
        return BoardUserSetting::forBoardAndUser($boardId, $userId)
                ->forSetting($setting)
                ->delete() > 0;
    }

    /**
     * Получить все настройки пользователя для доски
     */
    public function getAllSettings(int $boardId, int $userId): array
    {
        return BoardUserSetting::forBoardAndUser($boardId, $userId)
            ->get()
            ->pluck('value', 'setting')
            ->toArray();
    }
}
