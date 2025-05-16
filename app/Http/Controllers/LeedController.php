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

    public static function getAllUsersTelegram(int $leed_id): array
    {
        try {
            $e = LeedRecord::with([
                'userChanges' => function ($query) {
                    //                $query->orderBy('created_at', 'desc');
                    $query->with(['newUser' => function ($query) {
                        $query->select('id', 'telegram_id');
                    }

                    ]);
                },
            ])
                ->findOrFail($leed_id);

            $return = [];
//            dd($e->userChanges);
            foreach ($e->userChanges as $item0) {
//                foreach ($item0 as $item) {
                    $return[] = $item0->newUser->telegram_id;
//                }
            }
            $return1 = array_unique($return);
            return ['data' => $return1, 'leed' => $e];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
        }
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
