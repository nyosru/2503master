<?php

namespace App\Livewire\Board;

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvitationsList extends Component
{
    public $board_id;
    public $invitations = [];
    public $show_button_enter = false;
    public $only_for_now_user = false;

    public function mount()
    {

        $query = Invitation::query();

        if ($this->board_id) {
            $query->where('board_id', $this->board_id);
        }

        if ( !empty($this->only_for_now_user) ) {
            $user = Auth::user();
            $query->where('phone', $user->phone_number);
        }

        $this->invitations = $query->with(['role' => function ($query) {
            $query->select('id', 'name');
        }])->get();

    }


    public function render()
    {
        return view('livewire.board.invitations-list');
    }
}
