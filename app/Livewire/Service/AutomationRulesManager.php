<?php

namespace App\Livewire\Service;

use App\Models\Board;
use App\Models\LeadAutomation;
use App\Models\LeedColumn;
use Livewire\Component;

class AutomationRulesManager extends Component
{


    public $board_id;
    public $source_column_id;
    public $target_column_id;
    public $action;
    public $string1;
    public $string2;
    public $integer1;
    public $integer2;
    public $delay_days;
    public $is_active = false;

    protected $rules = [
        'board_id' => 'required|exists:boards,id',
        'source_column_id' => 'nullable|exists:leed_columns,id',
        'target_column_id' => 'nullable|exists:leed_columns,id',
        'action' => 'required|string|max:255',
        'delay_days' => 'nullable|integer|min:0',
        'is_active' => 'boolean'
    ];

    public function addRule()
    {
        $this->validate();

        LeadAutomation::create([
            'board_id' => $this->board_id,
            'source_column_id' => $this->source_column_id,
            'target_column_id' => $this->target_column_id,
            'action' => $this->action,
            'string1' => $this->string1,
            'string2' => $this->string2,
            'integer1' => $this->integer1,
            'integer2' => $this->integer2,
            'delay_days' => $this->delay_days,
            'is_active' => $this->is_active
        ]);

        $this->reset();
    }

    public function deleteRule($id)
    {
        LeadAutomation::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.service.automation-rules-manager', [
            'rules' => LeadAutomation::with(['board', 'sourceColumn', 'targetColumn'])
                ->latest()
                ->get(),
            'boards' => Board::all(),
            'columns' => LeedColumn::when($this->board_id, fn($q) => $q->where('board_id', $this->board_id))->get()
        ]);
    }

}
