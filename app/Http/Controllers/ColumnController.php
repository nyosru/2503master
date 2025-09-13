<?php

namespace App\Http\Controllers;

use App\Models\ColumnRole;
use App\Models\LeedColumn;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColumnController extends Controller
{


    /**
     * получить колонку которая принимает подготовленный договор от мененджера
     * @return LeedColumn
     */
    public static function getCanAcceptContract():LeedColumn
    {
        return LeedColumn::where('can_accept_contract', true)->first();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LeedColumn $leedColumn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeedColumn $leedColumn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeedColumn $leedColumn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeedColumn $leedColumn)
    {
        //
    }

    /**
     * Открыть доступ к колонке для должности(ей)
     */
    public function setVisibleColumnForRoles( LeedColumn $leedColumn , $roles  ):void
    {

        foreach($roles as $role_id ) {
            // Проверяем, есть ли уже доступ
            try {
                $access = ColumnRole::where('role_id', $role_id)->where('column_id', $leedColumn->id)->firstOrFail();
            } catch (\Exception $exception) {
                // Если доступа нет, создаем новую запись
                ColumnRole::create([
                    'role_id' => $role_id,
                    'column_id' => $leedColumn->id,
                ]);
//                return true;
            }
//            return false;
        }
    }


    /**
     * Пересчитывает порядок столбцов для указанного пользователя.
     * После добавления нового столбца, обновляется порядок всех последующих.
     *
     * @return void
     */
    public
    function reorderColumns()
    {
        if (env('APP_ENV', 'x') == 'local') {
            \Log::info('fn ' . __FUNCTION__, ['#' . __LINE__ . ' ' . __FILE__]);
        }

        $user_id = Auth::id();

        $columns = LeedColumn::orderBy('order') // Сортируем по текущему порядку
        ->get();

        $order = 1; // Начинаем с 1 для первого столбца
        foreach ($columns as $column) {
            // Присваиваем новый порядок для каждого столбца
            $order = $order + 2;
            $column->order = $order;
            $column->save();
        }
    }


    /**
     * Проверить, имеет ли колонка указанную роль
     */
    public function hasRole($role): bool
    {
        if (is_numeric($role)) {
            return $this->roles()->where('id', $role)->exists();
        }

        if (is_string($role)) {
            return $this->roles()->where('name', $role)->exists();
        }

        if ($role instanceof Role) {
            return $this->roles()->where('id', $role->id)->exists();
        }

        return false;
    }

    /**
     * Добавить роль к колонке
     */
    public function assignRole($role): void
    {
        if (is_numeric($role)) {
            $this->roles()->attach($role);
        } elseif (is_string($role)) {
            $roleModel = Role::where('name', $role)->first();
            if ($roleModel) {
                $this->roles()->attach($roleModel->id);
            }
        } elseif ($role instanceof Role) {
            $this->roles()->attach($role->id);
        }
    }

    /**
     * Удалить роль из колонки
     */
    public function removeRole($role): void
    {
        if (is_numeric($role)) {
            $this->roles()->detach($role);
        } elseif (is_string($role)) {
            $roleModel = Role::where('name', $role)->first();
            if ($roleModel) {
                $this->roles()->detach($roleModel->id);
            }
        } elseif ($role instanceof Role) {
            $this->roles()->detach($role->id);
        }
    }

    /**
     * Синхронизировать роли колонки
     */
    public function syncRoles(array $roleIds): void
    {
        $this->roles()->sync($roleIds);
    }

    /**
     * Получить ID ролей, имеющих доступ к колонке
     */
    public function getRoleIdsAttribute(): array
    {
        return $this->roles->pluck('id')->toArray();
    }


}
