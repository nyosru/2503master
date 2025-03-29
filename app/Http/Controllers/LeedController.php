<?php

namespace App\Http\Controllers;

use App\Models\LeedRecord;
use Illuminate\Http\Request;

class LeedController extends Controller
{
    public static function addNewClientToLeed(int $leed_id, int $client_id): bool
    {
        $leed = LeedRecord::find($leed_id);
        if ($leed && empty($leed->client_id)) {
            $leed->client_id = $client_id;
            return $leed->save();
        }
        return false;
    }

    public static function addNewOrderToLeed(int $leed_id, int $order_id): bool
    {
        $leed = LeedRecord::find($leed_id);
        if ($leed && empty($leed->order_id)) {
            $leed->order_id = $order_id;
            return $leed->save();
        }
        return false;
    }
}
