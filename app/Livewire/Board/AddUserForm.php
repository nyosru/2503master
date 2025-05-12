<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\BoardUser;
use Livewire\Component;

class AddUserForm extends Component
{
    public $board_id;
    public $user_id;
    public $role_id;

    // Правила валидации
    protected $rules = [
        'board_id' => 'required|integer|exists:boards,id',
        'user_id' => 'required|integer|exists:users,id',
        'role_id' => 'required|integer|exists:roles,id',
    ];

    // Сообщения об ошибках
    protected $messages = [
        'board_id.required' => 'Выберите доску.',
        'user_id.required' => 'Выберите пользователя.',
        'role_id.required' => 'Выберите роль.',
    ];

    // Обработка отправки формы
    public function save()
    {
        $this->validate();

        // Создание записи
        BoardUser::create([
            'board_id' => $this->board_id,
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
        ]);

        // Очистка формы
        $this->reset(['board_id', 'user_id', 'role_id']);

        // Уведомление об успешном добавлении
        session()->flash('message'.$this->board_id, 'Запись успешно добавлена!');

        // Отправка события с параметром postId
//        $this->dispatch('user-added', boardId: $this->board_id);
        $this->dispatch('user-added');
//        return redirect()->route('board');
        // Отправляем событие в JS, чтобы скрыть форму
        $this->dispatch('form-saved');
    }

    public function render()
    {
        $roles = \App\Models\Role::where('board_id', $this->board_id)->get();
//        dd(\App\Models\Role::all());

        return view('livewire.board.add-user-form', [
            'boards' => \App\Models\Board::all(),
            'users' => \App\Models\User::all(),
            'roles' => $roles,
        ]);
    }
}
