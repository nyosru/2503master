<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Models\Board;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeedBoardList extends Component
{

    public $boards;
    public $invite;

    public function mount()
    {

        // Fetch the authenticated user
        $user = Auth::user();
//dd($user);
        $this->invite = Invitation::where('phone', $user->phone_number)->with([
            'board' => function ($query) {
                $query->select('id', 'name');
            }
            , 'role' => function ($query) {
                $query->select('id', 'name');
            }
        ])->get();
//dd($this->invite->toArray());

        // Retrieve boards associated with the user via boardUsers relationship
        $this->boards = Board::whereHas('boardUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with([
                'boardUsers' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                    $query->with(['role']);
                },
                'invitations' => function ($query) {
                    $query->with(['role']);
                }
            ])
            ->get();

    }

    public function delete(Board $board)
    {
        BoardController::delete($board);
    }

    public function render()
    {
        // You can also use a separate query to retrieve boards associated with the use
        return view('livewire.cms2.leed.leed-board-list');
    }
}
