<?php

namespace App\Http\Controllers;

use App\Models\LeedMoneyMovement;
use Illuminate\Http\Request;

class LeedMoneyController extends Controller
{
    public static function getTotalAmount($lead_record_id)
    {
        $payments = LeedMoneyMovement::where('leed_record_id', $lead_record_id)->get();
        $totalAmount = $payments->sum('amount');
        return $totalAmount;
    }
}
