<?php

namespace App\Livewire\Column\Config;

use Livewire\Component;
use App\Models\LeedColumn;
use App\Models\Role;

class Access extends Component
{
    public int $columnId;

    /** @var LeedColumn|null */
    public $column;

    /** @var \Illuminate\Database\Eloquent\Collection|Role[] */
    public $roles;

    /** @var array role_id => bool (доступ включен или нет) */
    public array $accesses = [];

    public function mount(LeedColumn $column)
    {
        $this->columnId = $column->id;
        $this->loadData();
    }

    protected function loadData()
    {
        $this->column = LeedColumn::with('roles')->findOrFail($this->columnId);

        // Загружаем роли, привязанные к доске колонки
        $boardId = $this->column->board_id;

        $this->roles = Role::where('board_id', $boardId)->get();

        // Инициализируем массив доступов (есть связь — true, нет — false)
        $this->accesses = [];

        $rolesWithAccess = $this->column->roles->pluck('id')->toArray();

        foreach ($this->roles as $role) {
            $this->accesses[$role->id] = in_array($role->id, $rolesWithAccess);
        }
    }

    public function updatedAccesses($value, $key)
    {
        $roleId = (int)$key;
        $hasAccess = (bool)$value;

        if ($hasAccess) {
            // Добавляем доступ (если ещё нет)
            $this->column->roles()->syncWithoutDetaching([$roleId]);
        } else {
            // Удаляем доступ
            $this->column->roles()->detach($roleId);
        }
    }

    public function render()
    {
        return view('livewire.column.config.access');
    }
}
