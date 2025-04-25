<?php

namespace App\Livewire\Board;

use App\Http\Controllers\BoardController;
use App\Models\Board;
use App\Models\BoardFieldSetting;
use App\Models\LeedRecord;
use Livewire\Component;

class ConfigComponent extends Component
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
        return view('livewire.board.config-component');
    }
}
