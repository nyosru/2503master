<?php

namespace App\Livewire\Board\Config;

use App\Models\Board;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\Macros;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MacrosComponent extends Component
{
    public $board;


    public $macroses;
    public $macroId;

//    public $column_id;
    public $selectedColumns = []; // Для выбранных колонок
    public $allColumns = []; // Все доступные колонки

    public $leed_id;
    public $name;
    public $comment;

    public $type;
    public $to_telegrams;
    public $message;
    public $day;

    public $isEditMode;

    public $columns = [];
    public $leeds = [];
    public $selectedRoles = [];
    public $allRoles = [];

//    protected $rules = [];
    protected $rules = [
//        'column_id' => 'nullable|integer|exists:leed_columns,id',

        'selectedColumns' => 'array',
        'selectedColumns.*' => 'exists:leed_columns,id',

        'leed_id' => 'nullable|integer|exists:leed_records,id',
        'name' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:1000',
        'type' => 'nullable|string|max:255',
        'to_telegrams' => 'nullable|string|max:255',
        'message' => 'nullable|string',
        'day' => 'nullable|integer',
    ];


    public function mount( Board $board){

        $this->status = 'работает'; // статус по умолчанию
        $this->isEditMode = false;
//        $this->rules = [
//            'column_id' => 'nullable|integer|exists:leed_columns,id',
//            'leed_id' => 'nullable|integer|exists:leed_records,id',
//
//            'name' => 'required|string|max:255',
//            'comment' => 'nullable|string|max:1000',
//
//            'type' => 'nullable|string|max:255',
//            'to_telegrams' => 'nullable|string|max:255',
//            'message' => 'nullable|string',
//            'day' => 'nullable|integer',
//
////            'status' => ['required', Rule::in(['работает', 'не работает'])],
//        ];

        $this->board = $board;
        $this->loadMacros();

//        $this->columns = LeedColumn::orderBy('name')->get();
//        $this->leeds = LeedRecord::orderBy('name')->get();


//        $this->allColumns = LeedColumn::where('board_id', $this->board->id)->orderBy('order')->get();
        $this->allColumns = LeedColumn::all();

//        $this->columns = LeedColumn::where('board_id', $this->board->id)
//            ->orderBy('order')
//            ->get();

        $this->leeds = LeedRecord::whereHas('column', function ($query) {
            $query->where('board_id', $this->board->id);
        })->orderBy('name')->get();

        // Загрузка всех ролей
        $this->allRoles = Role::where('board_id', $this->board->id)->orderBy('name')->get();

    }


    public function loadMacros()
    {
        $this->macroses = Macros::with([
//            'column',
            'leed'
        ])->orderBy('created_at', 'desc')->get();
    }

    public function resetInput()
    {
        $this->reset([
//            'column_id',
            'leed_id', 'name', 'comment',
            'type', 'to_telegrams', 'message', 'day',
            'macroId', 'isEditMode',
            'selectedColumns',
        ]);
        $this->isEditMode = false;
    }

    public function create()
    {
        $this->validate();

        $macro = Macros::create([
//            'column_id' => $this->column_id,
            'leed_id' => $this->leed_id,
            'name' => $this->name,
            'comment' => $this->comment,
            'type' => $this->type,
            'to_telegrams' => $this->to_telegrams,
            'message' => $this->message,
            'day' => $this->day,
        ]);

        // Синхронизация ролей
        $macro->roles()->sync($this->selectedRoles);
        $macro->columns()->sync($this->selectedColumns);

        $this->loadMacros();
        $this->resetInput();
        session()->flash('message', 'Макрос успешно добавлен.');
    }

    public function edit($id)
    {
        $macro = Macros::findOrFail($id);

        $this->macroId = $macro->id;
//        $this->column_id = $macro->column_id;
        $this->leed_id = $macro->leed_id;
        $this->name = $macro->name;
        $this->comment = $macro->comment;
        $this->type = $macro->type;
        $this->to_telegrams = $macro->to_telegrams;
        $this->message = $macro->message;
        $this->day = $macro->day;

        // Загрузка связанных ролей
        $this->selectedRoles = $macro->roles->pluck('id')->toArray();
        $this->selectedColumns = $macro->columns->pluck('id')->toArray();

        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->macroId) {
            $macro = Macros::findOrFail($this->macroId);
            $macro->update([
//                'column_id' => $this->column_id,
                'leed_id' => $this->leed_id,
                'name' => $this->name,
                'comment' => $this->comment,
                'type' => $this->type,
                'to_telegrams' => $this->to_telegrams,
                'message' => $this->message,
                'day' => $this->day,
            ]);

            // Обновление связей с ролями
            $macro->roles()->sync($this->selectedRoles);
            $macro->columns()->sync($this->selectedColumns);

            $this->loadMacros();
            $this->resetInput();
            session()->flash('message', 'Макрос успешно обновлен.');
        }
    }

    public function delete($id)
    {
        $macro = Macros::findOrFail($id);
        $macro->delete();

        $this->loadMacros();
        session()->flash('message', 'Макрос успешно удален.');
    }

    public function render()
    {
        return view('livewire.board.config.macros-component');
    }
}
