<?php

namespace App\Livewire\Board;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Invitation;
use App\Models\Board;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class InvitationsForm extends Component
{
    public $show_select_board_id = true;
    public $board_id;
    public $phone;
    public $role_id;
    public $user_id;

    public $boards = [];
    public $roles = [];
    public $users = [];

    protected $rules = [
        'board_id' => 'required|exists:boards,id',
        'phone' => 'required|string|max:20',
        'role_id' => 'required|exists:roles,id',
        'user_id' => 'nullable|exists:users,id',
    ];
    public bool $showForm = false;

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function mount()
    {
        $this->boards = Board::all();
        if ($this->show_select_board_id === true) {
//            $this->roles = Role::all();
            $this->roles = [];
        } else {
            $this->roles = Role::where('board_id', $this->board_id)->get();
        }
//        $this->users = User::all();
        $this->user_id = Auth::id();
    }

    public function submit()
    {
        $this->validate();

//        $response = Http::post(route('board.invitations.store'), [
//            'board_id' => $this->board_id,
//            'phone' => $this->phone,
//            'role_id' => $this->role_id,
//            'user_id' => $this->user_id,
//        ]);
//
//        if ($response->successful()) {
//            session()->flash('message', 'Приглашение успешно создано!');
//            $this->reset(['board_id', 'phone', 'role_id', 'user_id']);
//            $this->emit('invitationCreated'); // если нужно обновить список
//        } else {
//            $this->addError('form', 'Ошибка при создании приглашения');
//        }

        Invitation::create([
            'board_id' => $this->board_id,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'user_id' => $this->user_id,
        ]);

        $this->showForm = false;
        session()->flash('message', 'Приглашение успешно создано!');
        $this->reset(['phone', 'role_id']);
    }


    public function render()
    {
        return view('livewire.board.invitations-form');
    }
}
