<?php

namespace App\Http\Controllers;

use App\Models\OrderPaymentType;
use Illuminate\Http\Request;

class OrderPaymentTypeController extends Controller
{
    /**
     * получить обьект с клиентами
     * @param $type default(*) | mini (id name types)
     * @return object Client
     */
    public static function get($type = ''): object|array
    {
        if ($type == 'mini') {
            $return = OrderPaymentType::select('id', 'name')
//                ->orderBy('order')
                ->get();
        } else {
            $return = OrderPaymentType::orderBy('order');
        }
        return $return;
    }
}
