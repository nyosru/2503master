<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedColumn;
use Livewire\Component;

class ColumnConfig extends Component
{

    public $column; // Храним объект столбца
    public $name_new; // Храним объект столбца

    public $settings = []; // Массив для хранения параметров
    public $modal_show = false; // ID текущего столбца для открытия модального окна

    public $named = [

        'can_move' => 'Можно двигать',
        'can_delete' => 'Можно удалить',

        'type_otkaz' => 'Тип столбца - отказники',
        'can_create' => 'Можно создавать лида',

        'can_transfer' => 'Можно передать лида (договор подписан)',
        'can_get' => 'Можно брать на себя лида (сразу в доске)',

//        'can_accept_contract' => 'Принимает договор от менеджера',
        ];
    protected $rules = [
        'settings' => [],
//        'settings.can_move' => 'boolean',
//        'settings.can_delete' => 'boolean',
//        'settings.type_otkaz' => 'boolean',
//        'settings.can_create' => 'boolean',
//        'settings.can_accept_contract' => 'boolean',
    ];



    public function mount(LeedColumn $column)
    {
//        $this->column = $column;
        $this->settings = [
            'name' => $column->name,
            'can_move' => $column->can_move,
            'can_delete' => $column->can_delete,
            'type_otkaz' => $column->type_otkaz,
            'can_create' => $column->can_create,
            'can_transfer' => $column->can_transfer,
            'can_get' => $column->can_get,
//            'can_accept_contract' => $column->can_accept_contract,
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
//            $this->dispatch('loadColumns');
//            $this->dispatch('render');
//            return redirect()->route('leed)');

        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }

    public function openModal()
    {
        $this->modal_show = true; // Устанавливаем ID текущего столбца
        // Загрузка настроек столбца (если необходимо)
//        $this->columnConfig(LeedColumn::findOrFail($columnId));
    }

//    public function columnConfig(LeedColumn $column)
//    {
//        // Устанавливаем объект столбца
//        $this->column = $column;
////        $this->settings = [
////            'can_move' => $column->can_move,
////            'can_delete' => $column->can_delete,
////            'type_otkaz' => $column->type_otkaz,
////            'can_create' => $column->can_create,
////        ];
//    }

    public function render()
    {
        return view('livewire.cms2.leed.column-config');
    }
}
