<?php

namespace App\Livewire\Cms2;

use App\Http\Controllers\UserController;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserList extends Component
{

    public $roles;
    public $users;
    public $stafs;
    public $selected_role_id = [];
    public $selected_staff = [];
    public $new_role_message = [];
    public $new_staff_message = [];

    protected $rules = [
        'selected_role_id.*' => 'nullable|exists:roles,id',
        'selected_staff.*' => 'nullable|exists:staff,id',
    ];


    public function deleteUser($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $this->load();
        } catch (\Exception $e) {

        }
    }
    public function unDeleteUser($id){
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            $this->load();
        } catch (\Exception $e) {

        }
    }
    public function updateRole($userId, $roleId)
    {
//        UserController::updateRole($userId, $roleId);
        $user = User::find($userId);

        if ($user && Role::find($roleId)) {
            $user->roles()->sync([$roleId]); // Используем sync для отвязки всех и добавления новой роли
            $this->new_role_message[$userId] = "Новая роль: " . Role::find($roleId)->name;
        } else {
            $this->new_role_message[$userId] = "Ошибка назначения роли.";
        }
    }

//    public function updateStaff($userId, $staffId)
//    {
//        $user = User::find($userId);
//
//        if ($user && \App\Models\Staff::find($staffId)) {
//            $user->staff_id = $staffId; // Установить новый staff_id
//            $user->save(); // Сохранить изменения
//
//            $this->new_staff_message[$userId] = "Привязан пользователь с marudi.store: " . \App\Models\Staff::find($staffId)->name;
//        } else {
//            $this->new_staff_message[$userId] = "Ошибка настройки связи с пользователем.";
//        }
//    }


    public function updatedSelectedRoleId($roleId, $userId)
    {
        if ($roleId) {
            $this->updateRole($userId, $roleId);
        }
    }    public function updatedSelectedStaff($staffId, $userId)
    {
        if ($staffId) {
            $this->updateStaff($userId, $staffId);
        }
    }

    public function load(){
        //        $this->users = User::with('roles','staff')->get();
        $this->users = User::withTrashed()->with([
//            'roles',
            'currentBoard',
            'boardUser' => function ($query) {
            $query->with([
                'board' => function ($query) {
                    $query->select('name', 'id');
                },
                'role' => function ($query) {
                    $query->select('name', 'id');
                }
            ]);
            }
        ])->get();
//        $this->users = User::all();
        $this->roles = Role::all();
//        $this->stafs = \App\Models\Staff::select('id','name','phone')->orderBy('name')->get();

    }
    public function mount()
    {
        $this->load();
        foreach($this->users as $i) {
            $this->selected_staff[$i->id] = $i->staff_id ?? '';
            $this->selected_role_id[$i->id] = $i->roles[0]->id ?? '';
            }

    }

    public function render()
    {
        return view('livewire.cms2.user-list', ['users' => $this->users]);
    }

}
