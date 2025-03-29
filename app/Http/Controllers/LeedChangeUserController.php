<?php

namespace App\Http\Controllers;

use App\Models\LeedRecord;
use App\Models\LeedRecordUserChange;
use App\Models\User;
use Illuminate\Http\Request;

class LeedChangeUserController extends Controller
{
    /**
     * @param LeedRecord $leedRecord
     * @param User $newUser
     * @return void
     */
    public static function changeUser(LeedRecord $leedRecord, User $newUser)
    {

        LeedRecordUserChange::create([
            'leed_record_id' => $leedRecord->id,
            'new_user_id' => $newUser->id,
        ]);

        $leedRecord->user_id = $newUser->id;
        $leedRecord->save();

        Logs2Controller::add('Лид / передан -> ' . $newUser->name , [
            'leed_record_id' => $leedRecord->id,
//                'type' => 'tech'
        ]);

    }
}
