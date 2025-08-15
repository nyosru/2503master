<?php

namespace App\Livewire;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

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
//            'newRoleName' => 'required|string|unique:roles,name|max:255',
//            'newRoleName' => 'required|string|max:255',
            'newRoleName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name_ru')->where(function ($query) {
                    return $query->where('board_id', $this->board_id);
                }),
            ],
            'board_id' => 'required|exists:boards,id' // Добавляем проверку
        ]);

        // Создание роли
        Role::create([
            'name_ru' => $this->newRoleName,
            'name' => $this->newRoleName.$this->board_id,
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
