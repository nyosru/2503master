<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectBoardForm extends Component
{
    public $user;
    public $current_board;


    public function setCurrentBoard($id)
    {

        $user_id = Auth::id();
        $new_board_id = BoardController::getCurrentBoard($user_id,$id);

        if (!empty($new_board_id)) {
            return redirect()->route('leed');
        }

//        foreach ($this->user->boardUser as $k) {
//            if ($k->id == $id) {
//                $this->current_board = $id;
//                $this->user->current_board_id = $id;
//                $this->user->save();
//                return redirect()->route('leed');
//            }
//        }

//        if( $board ){
//            $this->current_board = $board->id;
//            $user->current_board = $board->id;
//            $user->save();
//            return redirect()->route('leed');
//        }

    }


    public function render()
    {
//        $this->setCurrentBoard();
        return view('livewire.cms2.leed.select-board-form');
    }
}
