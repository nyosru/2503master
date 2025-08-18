<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Models\Board;
use App\Models\Domain;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeedBoardList extends Component
{

    public $domain_in_user_count;
    public $boards;
    public $invite;
    public $user;

    public function mount()
    {

        $this->domain_in_user_count = Domain::where('admin_user_id', Auth::user()->id)->count();

        // Fetch the authenticated user
        $this->user =
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
        $this->loadBoards();
    }

    public function loadBoards()
    {

        $user = $this->user;

        // Retrieve boards associated with the user via boardUsers relationship
        $this->boards = Board::whereHas('boardUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->orWhere('admin_user_id', $user->id)
            ->with([
                'domain',
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
        $board->delete();
        $this->loadBoards();
    }

    public function render()
    {
        // You can also use a separate query to retrieve boards associated with the use
        return view('livewire.cms2.leed.leed-board-list');
    }
}
