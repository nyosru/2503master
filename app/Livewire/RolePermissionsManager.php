<?php

namespace App\Livewire;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolePermissionsManager extends Component
{
    public $newRoleName = ''; // Поле для новой роли

    public $board_id;
    public $boards;

    // Метод для добавления новой роли
    public function mount(){
//        dd(Auth::User());
//        $this->board_id = Auth()->User()->board_id;
    }

    public function addRole()
    {
        $this->validate([
            'newRoleName' => 'required|string|unique:roles,name|max:255',
            'board_id' => 'required|exists:boards,id' // Добавляем проверку
        ]);

        // Создание роли
        Role::create([
            'name' => $this->newRoleName,
            'board_id' => $this->board_id // Сохраняем связь
        ]);

        // Редирект на маршрут с сообщением
        session()->flash('message', 'Роль успешно добавлена!');
        return redirect()->route('tech.role_permission'); // Поменяйте на нужный вам маршрут
    }

    public function render()
    {
        $this->boards = Board::all();
        return view('livewire.role-permissions-manager');
    }
}
