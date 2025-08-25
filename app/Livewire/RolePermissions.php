<?php

namespace App\Livewire;

use App\Models\Board;
use App\Models\PermissionSetting;
use App\Models\Role as Role2;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissions extends Component
{

    public $selectBoard;
    public $roles;
    public $permissions;
    public $permissionsSettings = [];
    public $rolePermissions = [];

    // Переменные для подтверждения удаления
    public $confirmingDelete = false;
    public $roleIdToDelete = null;
    public $boards;
    public $user_id;

    public function mount()
    {

        $this->user_id = auth()->id();
        $this->boards = Board::where('admin_user_id', $this->user_id)->get();

        // Загружаем роли и разрешения
        $board_id = $this->selectBoard;

//        $this->roles = Role::whereNull('deleted_at')
//            ->
//            where(function ($query) use ($board_id) {
//                if (!empty($board_id)) {
//                    $query->whereBoardId($board_id);
//                }
//            })
//            ->
//            with(['permissions'])->get();

        $this->loadRoles();

        $this->permissions = Permission::orderBy('sort', 'asc')->get();
        $this->permissionsSettings = PermissionSetting::whereForStart(true)->pluck('permission_id')->toArray();


        // Формируем массив для отметки галочек
        foreach ($this->roles as $role) {
            $this->rolePermissions[$role->id] = $role->permissions->pluck('id')->toArray();
        }

    }

    /**
     * настройка for_start для стартовых должностей при создании по шаблону
     * @param $permissionId
     * @return void
     */
    public function toggleStartPermission($permissionId)
    {

        try {
            $perm = PermissionSetting::where('permission_id', $permissionId)->FirstOrFail();
            $perm->for_start = !$perm->for_start;
            $perm->save();
        } catch (\Exception $e) {
            PermissionSetting::create(['permission_id' => $permissionId, 'for_start' => true]);
        }

    }

    public function loadRoles()
    {
        $board_id = $this->selectBoard;
        $this->roles = Role::whereNull('deleted_at')
            ->
            where(function ($query) use ($board_id) {
                if (!empty($board_id)) {
                    $query->whereBoardId($board_id);
                }
            })
            ->
            with(['permissions'])->get();
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

    function updatedSelectBoard($value)
    {
//        dd($value);
//        $this->boards = Board::where('admin_user_id', $this->user_id)->get();
//        $this->boards = Board::where('id', $this->selectBoard)->get();
        $this->loadRoles();
    }

    // Метод для инициации подтверждения удаления
    public function updatedSelectBoard2($value)
    {
        dd($value);
        $this->boards = Board::where('admin_user_id', $this->user_id)->get();
//        $this->mount();
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
