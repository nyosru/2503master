<?php

namespace App\Livewire;

use App\Models\Role as Role2;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissions extends Component
{
    public $roles;
    public $permissions;
    public $rolePermissions = [];

    // Переменные для подтверждения удаления
    public $confirmingDelete = false;
    public $roleIdToDelete = null;

    public function mount()
    {
        // Загружаем роли и разрешения
        $board_id = '';
        $this->roles = Role::whereNull('deleted_at')
            ->
            where(function ($query) use ($board_id) {
                if (!empty($board_id)) {
                    $query->whereBoardId($board_id);
                }
            })
            ->
            with(['permissions'])->get();

        $this->permissions = Permission::orderBy('sort', 'asc')->get();

        // Формируем массив для отметки галочек
        foreach ($this->roles as $role) {
            $this->rolePermissions[$role->id] = $role->permissions->pluck('id')->toArray();
        }
    }

    public function togglePermission($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        if ($role && $permission) {
            if ($role->hasPermissionTo($permission)) {
                // Удаляем разрешение у роли
                $role->revokePermissionTo($permission);
            } else {
                // Добавляем разрешение к роли
                $role->givePermissionTo($permission);
            }

            // Обновляем массив разрешений
            $this->rolePermissions[$roleId] = $role->permissions->pluck('id')->toArray();
        }
    }

    // Метод для инициации подтверждения удаления
    public function confirmDelete($roleId)
    {
        $this->confirmingDelete = true;
        $this->roleIdToDelete = $roleId;
    }

    // Метод для отмены удаления
    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->roleIdToDelete = null;
    }

    // Метод для выполнения удаления
    public function deleteRole($roleId)
    {
        $role = Role2::find($roleId);
        if ($role) {
//            $role->delete();
            $role->softDelete();
            session()->flash('message', 'Роль успешно удалена.');
//            $this->roles = Role::all(); // Обновляем список ролей
            $this->roles = Role::whereNull('deleted_at')->get(); // Обновляем список ролей
        }

        // Закрываем окно подтверждения после удаления
        $this->confirmingDelete = false;
        $this->roleIdToDelete = null;
    }

    public function render()
    {
        return view('livewire.role-permissions', [
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ]);
    }
}
