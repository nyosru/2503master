<?php

namespace App\Livewire;

use App\Models\Board;
use App\Models\ColumnRole;
use App\Models\LeedColumn;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class RoleColumnAccess extends Component
{

    public $roles;
    public $columns;
    public $boards;

    #[Url]
    public $board;

    public function mount()
    {

        $user = Auth::user();
//        $user_id = $user->id;

//        if ('р.Доски / видеть все доски') || $user->email == '1@php-cat.com' ) {
//            $needUsers = false; // или false
//        } else {
//            $needUsers = true; // или false
//        }


        if (
            $user->hasPermissionTo('тех.упр - путь заказа / видеть все доски')
            || $user->email == '1@php-cat.com'
            || $user->email == 'nyos@rambler.ru'
        ) {
            $this->boards = Board::all();
        }else{
            $this->boards = Board::where( 'admin_user_id', $user->id )->get();
        }

        $this->loadColumns();
//        $this->columns = LeedColumn::orderBy('order','asc')->get();
    }

    public function updatedBoard()
    {
        $this->loadColumns();
    }

    public function loadColumns()
    {

        if (!empty($this->board)) {

            // Получаем все роли и столбцы
            $this->roles = Role::
            when(!empty($this->board), function ($query) {
                $query->where('board_id', $this->board);
            })
                ->get();
//        dd($this->roles->toArray());


            $this->columns = LeedColumn::
//            where(function ($query) use ($board) {
//                $query->where('board_id', $this->board);
//            })
//                ->
            orderBy('order', 'asc')
                ->when(!empty($this->board), function ($query) {
                    $query->where('board_id', $this->board);
                })
                ->get();

        }
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
