<?php

namespace App\Livewire\Column;

use App\Http\Controllers\Services\MacrosController;
use App\Models\LeedColumn;
use App\Models\LeedColumnBackgroundColor;
use Livewire\Component;

class ColumnConfig extends Component
{

    public $column; // Храним объект столбца


    public $name_new; // Храним объект столбца

    public $menu = []; // меню
    public $modal_show = false; // ID текущего столбца для открытия модального окна
    public $macroses;
    public $show_tpl = '';

    public function showTplSet($tpl){
        $this->show_tpl = $tpl;
    }

    public function mount(LeedColumn $column)
    {

        $this->menu = [
            [
                'name' => 'Настройки',
                'template' => 'column.config.main'
            ],
//            [
//                'name' => 'Макросы',
//                'template' => 'column.config.macros'
//            ],
            [
                'name' => 'Доступы',
                'template' => 'column.config.access'
            ],

        ];
        $this->show_tpl = $this->menu[0]['template'];


//        $this->column = $column;
//        $this->settings = [
//            'name' => $column->name,
//            'can_move' => $column->can_move,
//            'can_delete' => $column->can_delete,
//            'type_otkaz' => $column->type_otkaz,
//            'can_create' => $column->can_create,
//            'can_transfer' => $column->can_transfer,
//            'can_get' => $column->can_get,
////            'can_accept_contract' => $column->can_accept_contract,
//        ];

        $m = new MacrosController();
        $this->macroses = $m->get( $column->id );
    }



//
//    public function saveColumnConfig()
//    {
//        try {
//            $this->validate();
//
//            // Обновляем объект столбца
//            $this->column->update($this->settings);
////            $this->column->save();
//
////            session()->flash('message', 'Настройки обновлены!');
//            $this->modal_show = false; // Закрываем модальное окно после сохранения
//
//            // Эмитируем событие на другой компонент
//            $this->dispatch('refreshLeedBoardComponent');
////            $this->dispatch('loadColumns');
////            $this->dispatch('render');
////            return redirect()->route('leed)');
//
//        } catch (\Exception $e) {
//            session()->flash('error', 'Ошибка при сохранении: ' . $e->getMessage());
//        }
//    }

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
        return view('livewire.column.column-config');
    }
}
