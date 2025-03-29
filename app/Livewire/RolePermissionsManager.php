<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolePermissionsManager extends Component
{
    public $newRoleName = ''; // Поле для новой роли

    // Метод для добавления новой роли
    public function addRole()
    {
        $this->validate([
            'newRoleName' => 'required|string|unique:roles,name|max:255',
        ]);

        // Создание роли
        Role::create(['name' => $this->newRoleName]);

        // Редирект на маршрут с сообщением
        session()->flash('message', 'Роль успешно добавлена!');
        return redirect()->route('tech.role_permission'); // Поменяйте на нужный вам маршрут
    }

    public function render()
    {
        return view('livewire.role-permissions-manager');
    }
}
