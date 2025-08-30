<?php

namespace App\Livewire\Board\One;

use Livewire\Component;

class ViewCanban extends Component
{

    public $columns;
    public $board_id;
    public $user;

    public function render()
    {
        return view('livewire.board.one.view-canban');
    }
}
