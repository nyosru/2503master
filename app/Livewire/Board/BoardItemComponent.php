<?php

namespace App\Livewire\Board;

use Livewire\Component;

class BoardItemComponent extends Component
{

    public $column;
    public $record;
    public $user_id;

    public function mount( ){
        $this->user_id = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.board.board-item-component');
    }
}
