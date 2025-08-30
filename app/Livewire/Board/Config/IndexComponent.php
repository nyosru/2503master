<?php

namespace App\Livewire\Board\Config;

use App\Models\Board;
use Livewire\Component;

class IndexComponent extends Component
{

    public $board;
    public $activeTab ;


    public function mount( Board $board){
        $this->board = $board;
    }

    public function render()
    {
        return view('livewire.board.config.index-component');
    }
}
