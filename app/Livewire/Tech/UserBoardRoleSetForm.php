<?php

namespace App\Livewire\Tech;

use App\Http\Controllers\UserController;
use Livewire\Component;

class UserBoardRoleSetForm extends Component
{
    public $user;

    public function mount($user){

    }

    public function setBoardRole( $user_id, $board_id, $role_id )
    {
        UserController::setBoardRole($user_id, $board_id, $role_id);
    }

    public function render()
    {
        return view('livewire.tech.user-board-role-set-form');
    }
}
