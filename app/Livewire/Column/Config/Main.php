<?php

namespace App\Livewire\Column\Config;

use App\Models\LeedColumn;
use Livewire\Component;

class Main extends Component
{
    public $column;
    public $modal_show = true; // Добавляем переменную для модального окна

    public $named = [

        'can_move' => 'Можно двигать',
        'can_delete' => 'Можно удалить',

        'type_otkaz' => 'Тип столбца - отказники',
        'can_create' => 'Можно создавать лида',

        'can_transfer' => 'Можно передать лида (договор подписан)',
        'can_get' => 'Можно брать на себя лида (сразу в доске)',
        'bg_color' => 'Цвет фона',
        'border_color' => 'Цвет обводки',
    ];
    protected $rules = [
        'settings.name' => 'required|string|max:255',
        'settings.bg_color' => 'required|string|max:7',
        'settings.border_color' => 'required|string|max:7',
        'settings.can_move' => 'boolean',
        'settings.can_delete' => 'boolean',
        'settings.type_otkaz' => 'boolean',
        'settings.can_create' => 'boolean',
        'settings.can_transfer' => 'boolean',
        'settings.can_get' => 'boolean',
    ];


    public $settings;

    public function mount(LeedColumn $column)
    {
        $this->column = $column;

        $this->settings = [
            'name' => $column->name,
            'can_move' => $column->can_move,
            'can_delete' => $column->can_delete,
            'type_otkaz' => $column->type_otkaz,
            'can_create' => $column->can_create,
            'can_transfer' => $column->can_transfer,
            'can_get' => $column->can_get,
            'bg_color' => $column->bg_color ?? '#ffffff',
            'border_color' => $column->border_color ?? '#e5e7eb',
        ];

    }



    public function saveColumnConfig()
    {
        try {
            $this->validate();

            // Обновляем объект столбца
            $this->column->update($this->settings);
//            $this->column->save();

//            session()->flash('message', 'Настройки обновлены!');
            $this->modal_show = false; // Закрываем модальное окно после сохранения

            // Эмитируем событие на другой компонент
            $this->dispatch('refreshLeedBoardComponent');
            $this->dispatch('columnUpdated', columnId: $this->column->id);

            session()->flash('CfgMainSuccess', 'Изменения сохранены');

        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.column.config.main');
    }
}
