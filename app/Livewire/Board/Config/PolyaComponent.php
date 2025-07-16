<?php

namespace App\Livewire\Board\Config;

use App\Http\Controllers\BoardController;
use App\Models\Board;
use App\Models\BoardFieldSetting;
use Livewire\Component;

class PolyaComponent extends Component
{

    public $board;
    public $leed1;
    public $cfg_polya;
    public $cfg_polya_data;

    public function mount( Board $board){
//        $this->leed1 = LeedRecord::first();
        $this->cfg_polya = BoardController::getPolyaConfig();
        $this->cfg_polya_data = BoardFieldSetting::whereBoardId($board->id)
            ->orderBy('sort_order','DESC')
            ->get();
    }

    public function render()
    {
        return view('livewire.board.config.polya-component');
    }
}
