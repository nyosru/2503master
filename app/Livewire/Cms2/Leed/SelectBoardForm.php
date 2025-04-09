<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectBoardForm extends Component
{
    public $user;
    public $current_board;

    public $name;

    public function store(){

        $this->validate([
            'name' => 'string|max:255',
        ]);

        $user_id = Auth::id();

        // Создание новой записи в базе данных
        $board = Board::create([
            'name' => $this->name,
//            'user_id' => $user_id,
        ]);
//        dd($board);

// Создание новой записи через отношение
        $board->boardUsers()->create([
            'user_id' => $this->user->id,
            'role_id' => 1,
        ]);

        $this->user->current_board_id = $board->id;
        $this->user->save();

//        $us = User::find($user_id);
////        dd([$us,$this->leed->toArray()]);
//        LeedChangeUserController::changeUser($leadRecord, $us);

//        // Добавление записи в LeadUserAssignment
//        LeadUserAssignment::create([
//            'lead_id' => $leadRecord->id,
//            'user_id' => $user_id,
//        ]);

        // Очистка полей после добавления
        $this->reset(['name']);

        session()->flash('boardAdded', 'Доска создана, создавайте этапы и пользуйтесь!');
        return redirect()->route('leed');

    }
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
