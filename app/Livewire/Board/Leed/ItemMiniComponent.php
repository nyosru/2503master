<?php

namespace App\Livewire\Board\Leed;

use App\Http\Controllers\LeedChangeUserController;
use App\Http\Controllers\LeedController;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\User;
use Livewire\Component;

class ItemMiniComponent extends Component
{

    public $columns = [];
    public $board_id;
    public $leed_id;
    public $leed;
    public $s;
    public $user;
    public $select_column_id;
    public $comment_now;

    public function checkSecret($s, $board_id, $leed_id){
        return $s == LeedController::createSecret( $board_id, $leed_id );;
    }

    public function createSecret( $board_id, $leed_id){
        return LeedController::createSecret( $board_id, $leed_id );
    }

    public function mount($board_id, $leed_id, $s = null)
    {

        $this->user = auth()->user();

        $userExistsInBoard = BoardUser::where( 'board_id', $board_id )
            ->where('user_id', $this->user->id )
            ->whereNull('deleted_at')
            ->exists();

        if ( $userExistsInBoard === false ) {
            session()->flash('error_all', 'Что то пошло не так, доступа ещё нет (Ошибка №7)');
        }
        elseif ( !request()->has('s') ) {
            session()->flash('error_all', 'Что то пошло не так (Ошибка №5)');
        }
        elseif ( !$this->checkSecret( request()->s , $board_id, $leed_id) ) {
            session()->flash('error_all', 'Что то пошло не так.  (Ошибка №3) ');
        }

        $this->leed = \App\Models\LeedRecord::find($leed_id);

    }


    public function render()
    {

        return view('livewire.board.leed.item-mini-component')
            ->layout('layouts.app-simple');
    }
}
