<?php

namespace App\Livewire;

use App\Models\ColumnRole;
use App\Models\LeedColumn;
use App\Models\Role;
use Livewire\Component;

class RoleColumnAccess extends Component
{

    public $roles;
    public $columns;

    public function mount()
    {
        // Получаем все роли и столбцы
        $this->roles = Role::all();
        $this->columns = LeedColumn::orderBy('order','asc')->get();
    }


    public function toggleAccess($roleId, $columnId)
    {
        // Проверяем, есть ли уже доступ
        $access = ColumnRole::where('role_id', $roleId)->where('column_id', $columnId)->first();

        if ($access) {
            // Если доступ уже есть, удаляем его
            $access->delete();
        } else {
            // Если доступа нет, создаем новую запись
            ColumnRole::create([
                'role_id' => $roleId,
                'column_id' => $columnId,
            ]);
        }

        // Обновляем состояние компонента
        $this->mount(); // Обновляем роли и столбцы
    }

    public function render()
    {
        return view('livewire.role-column-access');
    }
}
