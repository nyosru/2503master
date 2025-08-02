<?php

namespace App\Livewire\Macros;

use App\Models\LeedColumn;
use App\Models\MacroType;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Macros;
use Illuminate\Validation\Rule;
use App\Models\Board;

class Manager extends Component
{

//    public int|null $board_id = null;            // выбранная доска

    #[Url]
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


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:macros,name',
            'comment' => 'nullable|string|max:1000',
            'type_id' => 'required|exists:macro_types,id',
            'status' => 'nullable|string|max:255',
            'column_ids' => 'array',
            'column_ids.*' => 'exists:leed_columns,id',
        ];
    }

    protected function getEditingRules()
    {
        return [
            'editingName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('macros', 'name')->ignore($this->editingMacroId),
            ],
            'editingComment' => 'nullable|string|max:1000',
            'editingTypeId' => 'required|exists:macro_types,id',
            'editingStatus' => 'nullable|string|max:255',
            'editingColumnIds' => 'array',
            'editingColumnIds.*' => 'exists:leed_columns,id',
        ];
    }

    public function mount()
    {
        $this->boards = Board::has('columns')->orderBy('name')->get();
        $this->macroTypes = MacroType::where('status', true)->orderBy('name')->get();

        $this->columns = [];
        $this->column_ids = [];
//        $this->loadMacroses();
    }

    // При изменении выбранной доски загружаем столбцы
    public function updatedBoardId($value)
    {
//        if ($value) {
//dd($value);
//dd($this->board_id);
        Log::debug('Это тестовое сообщение для debug bar');


            $this->columns = LeedColumn::where('board_id', $this->board_id)->orderBy('name')->get();
//            $this->columns = LeedColumn::orderBy('name')->get();

            // Сброс выбранных колонок при смене доски
            $this->column_ids = [];
            // Обновляем макросы с учетом выбранной доски (пока без фильтра по колонкам)
//            $this->loadMacroses();
//        } else {
//            $this->columns = [];
//            $this->column_ids = [];
//            $this->macroses = [];
////            $this->loadMacroses();
//        }
    }


    public function loadMacroTypes()
    {
        $this->macroTypes = MacroType::where('status', true)->orderBy('name')->get();
    }

    public function loadColumns()
    {
        // Загружаем все колонки (можно фильтровать по доске если нужно)
        $this->columns = LeedColumn::orderBy('name')->get();
    }

//    public function updatedColumnIds()
//    {
//        $this->loadMacroses();
//    }

    public function addMacro()
    {
        $this->validate();

        $macro = Macros::create([
            'name' => $this->name,
            'comment' => $this->comment,
            'type_id' => $this->type_id,
            'status' => $this->status,
        ]);

        // Привязать выбранные колонки
        $macro->columns()->sync($this->column_ids);

        $this->reset(['name', 'comment', 'type_id', 'status', 'column_ids']);
//        $this->loadMacroses();

        session()->flash('success', 'Макрос успешно добавлен.');
    }

    public function edit(Macros $macro)
    {
        $this->editingMacroId = $macro->id;
        $this->editingName = $macro->name;
        $this->editingComment = $macro->comment;
        $this->editingTypeId = $macro->type_id;
        $this->editingStatus = $macro->status;
        $this->editingColumnIds = $macro->columns->pluck('id')->toArray();
    }

    public function updateMacro()
    {
        $this->validate($this->getEditingRules());

        $macro = Macros::find($this->editingMacroId);

        if (!$macro) {
            session()->flash('error', 'Макрос не найден.');
            $this->cancelEdit();
            return;
        }

        $macro->update([
            'name' => $this->editingName,
            'comment' => $this->editingComment,
            'type_id' => $this->editingTypeId,
            'status' => $this->editingStatus,
        ]);

        // Обновляем связи с колонками
        $macro->columns()->sync($this->editingColumnIds);

        session()->flash('success', 'Макрос успешно обновлен.');
        $this->cancelEdit();
//        $this->loadMacroses();
    }

    public function cancelEdit()
    {
        $this->reset([
            'editingMacroId',
            'editingName',
            'editingComment',
            'editingTypeId',
            'editingStatus',
            'editingColumnIds',
        ]);
    }

    public function render()
    {
        return view('livewire.macros.manager');
    }

}
