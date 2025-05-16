<?php

namespace App\Livewire\Leed;

use App\Http\Controllers\LeedChangeUserController;
use App\Http\Controllers\Logs2Controller;
use App\Models\LeedRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActionGet extends Component
{

    public $leed;
    public $board_id;

    public function getThisLeed(){
        $us = Auth::user();
//        dd([$us,$this->leed->toArray()]);
        Logs2Controller::add('Беру лид в работу', [
            'leed_record_id' => $this->leed->id,
//                'type' => 'tech'
        ]);
        LeedChangeUserController::changeUser($this->leed, $us);
        return redirect()->route('leed.item', [
            'board_id' => $this->board_id,
            'id' => $this->leed->id
        ]);
    }

    public function render()
    {
        return view('livewire.leed.action-get');
    }
}
