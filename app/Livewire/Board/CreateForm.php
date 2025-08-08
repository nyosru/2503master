<?php

namespace App\Livewire\Board;

use App\Http\Controllers\UserController;
use App\Models\Board;
use Livewire\Component;

class CreateForm extends Component
{

    public $name;
    public $is_paid = true;
    public $return_route = 'board';
    public $show_payes = true;
    public $show_form = false;
    public $create_dolgnost_and_me = true;


    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
//            'selectedUsers' => 'required|array|min:1',
//            'selectedUsers.*' => 'exists:users,id',
//            'userRoles.*' => 'nullable|exists:roles,id', // Валидация role_id
//            'admin_user_id.*' => 'nullable|exists:roles,id', // Валидация role_id
            'is_paid' => 'boolean',
            'create_dolgnost_and_me' => 'boolean',
        ]);

        $admin_user_id = auth()->user()->id;

        // Создать доску
        $board = Board::create([
            'name' => $this->name,
            'is_paid' => $this->is_paid,
            'admin_user_id' => $admin_user_id,
        ]);

//        // Привязать пользователей с role_id
//        foreach ($this->selectedUsers as $userId) {
//            $board->users()->attach($userId, ['role_id' => $this->userRoles[$userId] ?? null]);
//        }

        if ($this->create_dolgnost_and_me) {
            $ee = UserController::creaeDefaultRoleAndLinkingMe('Тех. поддержка', $board->id, $admin_user_id);
//            dd($ee ?? 'x');
//            dd([__LINE__]);
        }

        $this->reset(['name',
//            'selectedUsers', 'userRoles',
            'is_paid']);
        session()->flash('message', 'Доска создана!');
//        return redirect()->route('board');
        return redirect()->route($this->return_route);
    }


    public function render()
    {
        return view('livewire.board.create-form');
    }

}
