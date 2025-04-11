<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeedBoardList extends Component
{

    public $boards;

    public function mount(){

        // Fetch the authenticated user
        $user = Auth::user();

        // Retrieve boards associated with the user via boardUsers relationship
        $this->boards = Board::whereHas('boardUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with(['boardUsers' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
                $query->with(['role']);
            }])
            ->get();

    }
    public function render()
    {


        // You can also use a separate query to retrieve boards associated with the use
        return view('livewire.cms2.leed.leed-board-list');
    }
}
