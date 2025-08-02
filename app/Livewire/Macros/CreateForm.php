<?php

namespace App\Livewire\Macros;

use Livewire\Component;

class CreateForm extends Component
{

    public $board_id ;            // выбранная доска

    public $boards;                             // список досок для селекта

    public $columns;                  // столбцы выбранной доски
    public array $column_ids = [];               // выбранные колонки для фильтрации

    public string $name = '';
    public string $comment = '';
    public int|null $type_id = null;
    public string $status = '';

    public ?int $editingMacroId = null;
    public string $editingName = '';
    public string $editingComment = '';
    public int|null $editingTypeId = null;
    public string $editingStatus = '';

    // Для множественного выбора колонок
    public array $editingColumnIds = []; // для редактирования

    public $macroses;
    public $macroTypes;


    public function render()
    {
        return view('livewire.macros.create-form');
    }
}
