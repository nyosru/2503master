<?php

namespace App\Livewire\Board\Leed;

use App\Http\Controllers\LeedChangeUserController;
use Livewire\Component;

class ItemMiniMoveLeedForm extends Component
{

    public $leed;
    public $user;
    public $columns;
    public $board_id;
    public $select_column_id;

    public function mount($board_id)
    {
        $this->columns = \App\Models\LeedColumn::where('board_id', $board_id)->where('id', '!=', $this->leed->id)->get();
        $this->user = auth()->user();
    }

    public function moveToColumn()
    {
        try {


            if( $this->leed->user_id != $this->user->id ) {
                LeedChangeUserController::changeUser($this->leed, $this->user);
            }

            $this->leed->leed_column_id = $this->select_column_id;
            $this->leed->save();

            session()->flash('success_move_column', 'Перемещено');
        } catch (\Exception $e) {
            dump($e);
            session()->flash('error_move_column', 'Произошла ошибка при перемещении лида, повторите, через 2 минуты');
        }
    }

    public function render()
    {
        return view('livewire.board.leed.item-mini-move-leed-form');
    }
}
