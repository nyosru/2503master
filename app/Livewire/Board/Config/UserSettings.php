<?php

namespace App\Livewire\Board\Config;

use App\Models\Board;
use App\Models\BoardUserSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserSettings extends Component
{
    public Board $board;
    public array $settings = [
        'view_type' => 'доска',
        'cards_per_page' => 20,
        'show_avatars' => true,
        'compact_mode' => false,
    ];

    protected $rules = [
        'settings.view_type' => 'required|in:доска,таблица',
        'settings.cards_per_page' => 'required|integer|min:5|max:100',
        'settings.show_avatars' => 'boolean',
        'settings.compact_mode' => 'boolean',
    ];

    // Лейблы для настроек
    protected array $settingLabels = [
        'view_type' => 'Режим отображения',
        'cards_per_page' => 'Карточек на странице',
        'show_avatars' => 'Показывать аватары',
        'compact_mode' => 'Компактный режим',
    ];

    // Опции для выпадающих списков
    protected array $settingOptions = [
        'view_type' => [
            'доска' => 'Доска (канбан)',
            'таблица' => 'Таблица',
        ],
    ];

    public function mount(Board $board)
    {
        $this->board = $board;
        $this->loadUserSettings();
    }

    /**
     * Загружаем все настройки пользователя для доски
     */
    private function loadUserSettings(): void
    {
        $userSettings = BoardUserSetting::forBoardAndUser($this->board->id, Auth::id())->get();

        foreach ($userSettings as $setting) {
            if (array_key_exists($setting->setting, $this->settings)) {
                $this->settings[$setting->setting] = $setting->getValue();
            }
        }
    }

    /**
     * Сохраняем все настройки
     */
    public function saveSettings(): void
    {
        $this->validate();

        foreach ($this->settings as $settingKey => $value) {
            $this->saveSingleSetting($settingKey, $value);
        }

        session()->flash('userSettingsSuccess', 'Настройки успешно сохранены!');
        $this->dispatch('userSettingsUpdated', settings: $this->settings);
    }

    /**
     * Сохраняем одну настройку
     */
    private function saveSingleSetting(string $settingKey, $value): void
    {
        $data = [
            'board_id' => $this->board->id,
            'user_id' => Auth::id(),
            'setting' => $settingKey,
        ];

        if (is_int($value) || is_bool($value)) {
            $data['numeric_value'] = (int)$value;
            $data['string_value'] = null;
        } else {
            $data['string_value'] = $value;
            $data['numeric_value'] = null;
        }

        BoardUserSetting::updateOrCreate(
            ['board_id' => $this->board->id, 'user_id' => Auth::id(), 'setting' => $settingKey],
            $data
        );
    }

    /**
     * Сбрасываем настройки к значениям по умолчанию
     */
    public function resetToDefault(): void
    {
        $defaultSettings = [
            'view_type' => 'доска',
            'cards_per_page' => 20,
            'show_avatars' => true,
            'compact_mode' => false,
        ];

        // Удаляем все пользовательские настройки для этой доски
        BoardUserSetting::forBoardAndUser($this->board->id, Auth::id())->delete();

        $this->settings = $defaultSettings;

        session()->flash('userSettingsSuccess', 'Настройки сброшены к значениям по умолчанию!');
        $this->dispatch('userSettingsUpdated', settings: $this->settings);
    }

    /**
     * Получить лейбл для настройки
     */
    public function getLabel(string $settingKey): string
    {
        return $this->settingLabels[$settingKey] ?? ucfirst(str_replace('_', ' ', $settingKey));
    }

    /**
     * Получить опции для настройки (если есть)
     */
    public function getOptions(string $settingKey): ?array
    {
        return $this->settingOptions[$settingKey] ?? null;
    }

    public function render()
    {
        return view('livewire.board.config.user-settings');
    }
}
