<?php

namespace App\Livewire\Board;

use App\Models\LeedRecord;
use Livewire\Component;

class BoardItemComponent extends Component
{

    public $column;
    public $record;
    public $user_id;

    public function mount( LeedRecord $record ){
        $this->record = $record;
        $this->user_id = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.board.board-item-component');
    }
}
