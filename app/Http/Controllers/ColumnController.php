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





}
