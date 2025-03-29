<?php

namespace App\Http\Controllers;

use App\Models\LeadUserAssignment;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    /**
     * передача лида другому ползователю
     * @param LeedRecord $record какой лид
     * @param User $toUser кому передать
     * @return string[]
     */
    public static function sendRecordToColumnUser(LeedRecord $record, $to_user_id): array
    {
        $return = ['status' => 'ok', 'info' => ''];
        try {
            $record->update([
                'user_id' => $to_user_id
            ]);
            LeadUserAssignment::create([
                'leed_id' => $record->id,
                'user_id' => $to_user_id
            ]);
        } catch (\Exception $ex) {
            $return['status'] = 'error';
            $return['info'] = $ex->getMessage();
        }
        return $return;
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
    public function show(LeedRecord $leedRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeedRecord $leedRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeedRecord $leedRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeedRecord $leedRecord)
    {
        //
    }
}
