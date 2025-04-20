<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\LeedChangeUserController;
use App\Http\Controllers\UserController;
use App\Models\BoardUser;
use App\Models\LeedRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Move extends Component
{
    public $isOpen = false;
    public $selectedUser;
    public $user_id;
    public $leed_id;
    public $leed;
    public $board_id;

//    public function mount(LeedRecord $leed)
//    {
//        $this->leed = $leed;
////        dd($this->leed_id);
////        $this->leed_id = LeedRecord::findOrFail($leed_id);
//        $this->user_id = Auth::id();
//    }

    public function render()
    {

        $users = User::where('id', '!=', $this->leed->user_id)
            ->with([
                'roles' => function ($q2) {
                    $q2->select('name')->first();
                },
            ])->get();
//        dd(Auth()->user());
        $move_variants = BoardController::getBoardUser($this->board_id);
        // Используем метод unique() для фильтрации коллекции
        $move_variants = $move_variants->unique('user_id');

        return view('livewire.cms2.leed.move', compact('users','move_variants'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function submit()
    {

        $us = User::find($this->selectedUser);
//        dd([$us,$this->leed->toArray()]);
        LeedChangeUserController::changeUser($this->leed, $us);
//        LeedChangeUserController::changeUser($this->leed, $this->selectedUser);

        session()->flash('moveMessage', 'Лид передан');

        return $this->redirectRoute('leed.item',[
            'id' => $this->leed->id,
            'board_id' => $this->leed->column->board_id
        ]);
    }
}
