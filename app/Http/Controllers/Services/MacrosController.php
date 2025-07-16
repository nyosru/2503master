<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Macros;
use Illuminate\Http\Request;

class MacrosController extends Controller
{

    public function get( int $column_id ){

        $macroses = Macros::
            whereHas('columns', function($query) use( $column_id ){
                $query->where('leed_columns.id', $column_id );
            })
////        whereColumnId($column_id)
            ->
            with([
                'columns',
                'leed',
                'roles',
//                'moveToColumn',
                'moveToColumnData',

// 'column' => function ($q) {
////                $q->with([
////                    'records' => function ($q) {
////                        $q->with('leedComments');
////                    }
////                ]);
//            },
//            'leed',
//            'roles.users'
//            => function ($q) {
//            $q->select('id', 'name', 'telegram_id','phone_number');
//            }
        ])
        ->get()
        ;

        return $macroses->toArray();

    }

    public function actionNow()
    {
        $response = [
            'data' => [],
            'status' => 'success',
        ];

//        $response['data'] = Macros::orderBy('created_at', 'desc')->first();
        $response['data'] =
        $macroses = Macros::with([
            'column' => function ($q) {
                $q->with([
                    'records' => function ($q) {
                        $q->with('leedComments');
                    }
                ]);
            },
            'leed',
            'roles.users'
//            => function ($q) {
//            $q->select('id', 'name', 'telegram_id','phone_number');
//            }
        ])->get();

        $response['data2'] = [ 'items'=>  [] ];

        foreach ($macroses as $macros) {
            $response['data2']['items'][] = $this->checkMacrosType($macros);
        }

        return $response;
    }

    public function checkMacrosType($macros)
    {

        $response = [
            'data' => [],
            'status' => 'success',
        ];

        $response['data'] = $macros->toArray();

        return $response;

    }

}
