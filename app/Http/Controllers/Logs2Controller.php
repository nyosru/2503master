<?php

namespace App\Http\Controllers;

use App\Models\Logs2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logs2Controller extends Controller
{

    public static $polya_dop = [
        'leed_record_id',
        'order_id',
        'user_id',
        'type'
    ];

    public static function add(
        $text,
        array $option = [
            'leed_record_id' => '',
            'order_id' => '',
            'type' => '',
            'user_id' => ''
        ]
    ) {
        $in = [
            'comment' => $text,
            'type' => 'tech',
            'created_at' => now(),
        ];

        $user_id = Auth::id();
        if (!empty($user_id)) {
            $in['user_id'] = $user_id;
        }

        foreach (self::$polya_dop as $i) {
            if (!empty($option[$i])) {
                $in[$i] = $option[$i];
            }
        }
//
//        if (!empty($option['autor_id'])) {
//            $in['autor_id'] = $option['autor_id'];
////            $in['autor_id'] = $this->autor_id;
////            $in['autor_id'] => Auth::id(),
//        }

//            'leed_record_id' => $leedRecord->id,

        Logs2::create($in);
    }
}
