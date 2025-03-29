<?php

namespace App\Http\Controllers;

use App\Models\LeedColumn;
use Illuminate\Http\Request;

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
}
