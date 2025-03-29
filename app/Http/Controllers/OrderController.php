<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPaymentType;
use App\Models\OrderRolesLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * готовим всякие заглушки для заполнения данных по текущей crm
     * @return array
     */
    public static function prepareOldDataToSave(array $validatedData, $metki = []): array
    {
        $v = OrderPaymentType::findOrFail($validatedData['order_payment_type_id'])->first();
        $validatedData['type_payments'] = $v->var_to_one;

        $validatedData['labels'] = implode(',', $metki);

        $validatedData['form_id'] = 4;

        try {
            $user = User::select('id', 'staff_id')->findOrFail(Auth::id())->first();
            $validatedData['manager_id'] = $user->staff_id;
        } catch (\Exception $ex) {
        }

        if (!empty($validatedData['montag_date']) || !empty($validatedData['montag_date_comment'])) {
            $validatedData['ready_dates'] = [
                [
                    'date' => $validatedData['montag_date'],
                    'comment' => $validatedData['montag_date_comment'],
                ]
            ];
        }

        return $validatedData;
    }

    /**
     * @return array
     */
    public static function prepareDataToSave(array $validatedData): array
    {
        if ($validatedData['urgently']) {
            $validatedData['urgently'] = 'yes';
        } else {
            unset($validatedData['urgently']);
        }

//        $validatedData['updated_at'] = time();
//
        $maxVirtualOrderId = Order::select('virtual_order_id')->max('virtual_order_id');
        $validatedData['virtual_order_id'] = $maxVirtualOrderId + 1;

        $validatedData['dogovor_number'] = date('y') . '-' . $validatedData['virtual_order_id'];

        return $validatedData;
    }

    public static function addOrder(array $validatedData, $metki = []): Order
    {
        $data = self::prepareDataToSave($validatedData, $metki);
        $data = self::prepareOldDataToSave($data);
        $new_order = Order::create($data);

        $OrderRolesLog = OrderRolesLog::create([
            'order_id' => $new_order->id,
            'staff_id' => $data['manager_id'],
//            'comment'
            'ts' => now()
        ]);

//        dd([$new_order->toArray(),$OrderRolesLog->toArray()]);

//        if (!empty($metki)) {
//            $new_order->labels()->attach($metki);
//        }

        return $new_order;
    }
}
