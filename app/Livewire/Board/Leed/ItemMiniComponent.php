<?php

namespace App\Livewire\Board\Leed;

use App\Http\Controllers\LeedController;
use Livewire\Component;

class ItemMiniComponent extends Component
{

    public $columns = [];
    public $board_id;
    public $leed_id;
    public $leed;
    public $s;
    public $select_column_id;
    public $comment_now;

    public function checkSecret($s, $board_id, $leed_id){
        return $s == $this->createSecret( $board_id, $leed_id);
    }

    public function createSecret( $board_id, $leed_id){
        return LeedController::createSecret( $board_id, $leed_id );
    }

    public function mount($board_id, $leed_id, $s = null)
    {
        if (!request()->has('s') ) {
            session()->flash('error_all', 'Что то пошло не так');
        }
        elseif ( !$this->checkSecret( request()->s , $board_id, $leed_id) ) {
            session()->flash('error_all', 'Что то пошло не так.');
        }


        $this->leed = \App\Models\LeedRecord::find($leed_id);
        $this->columns = \App\Models\LeedColumn::where('board_id', $board_id)->where('id', '!=', $leed_id)->get();
    }

    public function moveToColumn()
    {
        try {
            $this->leed->leed_column_id = $this->select_column_id;
            $this->leed->save();
            session()->flash('success_move_column', 'Перемещено');
        } catch (\Exception $e) {
            session()->flash('error_move_column', 'Произошла ошибка при перемещении лида, повторите, через 2 минуты');
        }
    }

    public function addComment()
    {
        try {
            $this->leed->leedComments->create([
                'comment' => $this->comment_now,
                'user_id' => auth()->user()->id
            ]);
            $this->leed->save();
            session()->flash('success_move_column', 'Перемещено');
        } catch (\Exception $e) {
            session()->flash('error_move_column', 'Произошла ошибка при перемещении лида, повторите, через 2 минуты');
        }
    }

    public function render()
    {

        return view('livewire.board.leed.item-mini-component')
            ->layout('layouts.app-simple');
    }
}
