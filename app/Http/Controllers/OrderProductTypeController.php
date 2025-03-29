<?php

namespace App\Http\Controllers;

use App\Models\OrderProductType;
use Illuminate\Http\Request;

class OrderProductTypeController extends Controller
{
    /**
     * получить обьект с клиентами
     * @param $type default(*) | mini (id name types)
     * @return object Client
     */
    public static function get($type = ''): object|array
    {
        if ($type == 'mini') {
            $return = OrderProductType::select('id', 'name', 'types')
                ->orderBy('order')
                ->get();
        } else {
            $return = OrderProductType::orderBy('order');
        }
        return $return;
    }
}
