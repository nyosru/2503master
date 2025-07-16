<?php

namespace App\Livewire\Column;

use App\Models\LeedColumn;
use Livewire\Component;
use App\Livewire\Forms\MacroForm;

class ConfigMacroForm extends Component
{

    public MacroForm $form;

    public int $board_id;
    public int $column;
    public string $type;

    // Список колонок для select
    public $columnsList = [];

    public function mount(int $column, string $type, ?int $board_id = null )
    {

        $this->column = $column;
        $this->type = $type;

        // Загружаем все колонки для выпадающего списка
        $this->columnsList = LeedColumn::where('board_id', $board_id)
            ->where('id', '!=', $this->column)
            ->orderBy('order')
            ->get();

//        $this->form = new MacroForm();

        $this->form->columns = [$this->column];
        $this->form->type = $this->type;

        // Инициализируем move_to_column пустым (null)
        $this->form->move_to_column = null;

        // day оставляем для ввода пользователем
        $this->form->day = 1;
    }

    public function save()
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', 'Макрос успешно добавлен');

        $this->form->day = 0;
        $this->form->move_to_column = null;
    }

    public function render()
    {
        return view('livewire.column.config-macro-form');
    }
}
