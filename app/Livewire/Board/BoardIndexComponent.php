<?php

namespace App\Livewire\Board;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BoardIndexComponent extends Component
{

    public $user_now;

    public function load(){
        $this->user_now = User::whereId(Auth::id())
            ->with([
                'currentBoard',
//                'role' => function ($query) {},
                'boards' => function ($query) {
                },
                'roles',
//                'boards.pivot.role' => function ($query) {
//                    $query->select('id', 'name');
//                },
//                'boards.pivot.role' => function ($query) {},
//                'boards.role' => function ($query) {
//                    // Получаем связанную роль через pivot-таблицу
////                    $query->select('id', 'name');
//                },
            ])
//            ->withPivot('role')
            ->first();
    }

    public function render()
    {
        $this->load();
        return view('livewire.board.board-index-component');
    }
}
