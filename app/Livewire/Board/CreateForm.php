<?php

namespace App\Livewire\Board;

use App\Models\Board;
use Livewire\Component;

class CreateForm extends Component
{

    public $name;
    public $is_paid = false;
    public $return_route = 'board';
    public $show_payes = true;
    public $show_form = false;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
//            'selectedUsers' => 'required|array|min:1',
//            'selectedUsers.*' => 'exists:users,id',
//            'userRoles.*' => 'nullable|exists:roles,id', // Валидация role_id
            'is_paid' => 'boolean',
        ]);

        // Создать доску
        $board = Board::create([
            'name' => $this->name,
            'is_paid' => $this->is_paid,
        ]);

//        // Привязать пользователей с role_id
//        foreach ($this->selectedUsers as $userId) {
//            $board->users()->attach($userId, ['role_id' => $this->userRoles[$userId] ?? null]);
//        }

        $this->reset(['name',
//            'selectedUsers', 'userRoles',
            'is_paid']);
        session()->flash('message', 'Доска создана!');
//        return redirect()->route('board');
        return redirect()->route( $this->return_route );
    }


    public function render()
    {
        return view('livewire.board.create-form');
    }

}
