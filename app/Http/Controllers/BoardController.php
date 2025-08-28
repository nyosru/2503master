<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardFieldSetting;
use App\Models\BoardUser;
use App\Models\OrderRequest;
use App\Models\OrderRequestsRename;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{

    public static $polya_config = [];

    public static function getPolyaConfig($board_id = null)
    {
        if ($board_id == 'all') {
            self::$polya_config = OrderRequest::all();
        } else {
            self::$polya_config = OrderRequest::whereHas('boardFieldSetting', function ($query) use ($board_id) {

                if (!empty($board_id))
                    $query->where('board_id', $board_id);

            })
                ->get();
//            ->all();
//        dd(self::$polya_config);
        }
        return self::$polya_config;
    }


    /**
     * @param $board_id
     * @param $pole
     * @param $name
     * @param $description
     * @param $sort
     * @param $is_enabled
     * @param $show_on_start
     * @param $in_telega_msg
     * @return void
     */
    public static function setRenamePolya($board_id, $pole, $name, $description,
                                          $sort,
                                          $is_enabled = false, $show_on_start = false, $in_telega_msg = false
    )
    {
        $s = BoardFieldSetting::create(['board_id' => $board_id, 'field_name' => $pole,
            'sort_order' => $sort,
            'is_enabled' => ($is_enabled ? true : false), 'show_on_start' => ($show_on_start ? true : false), 'in_telega_msg' => ($in_telega_msg ? true : false)]);
//        dump($s);
        try {
            $ss = OrderRequest::where('pole', $pole)->firstOrFail();
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        OrderRequestsRename::create(['board_id' => $board_id, 'order_requests_id' => $ss->id,
            'name' => $name, 'description' => $description]);

        return;

        $ee = OrderRequestsRename::updateOrCreate(
            [
                'board_id' => $board_id,
                'order_requests_id' => $order_requests_id
            ],
            [
                'name' => $name,
                'description' => $description
            ]
        );
        return $ee;

    }


    public static function getRules($board_id): array
    {
        $rules = [];
        $e = self::getPolyaConfig($board_id);
//        dd($e);
        foreach ($e as $v) {
            $rules[$v['pole']] = $v['rules'];
        }
        return $rules;
    }

    public static function enterAs($board_id, $role_id)
    {
//        dd($board_id, $role_id);

        $user = Auth::user();

        $boards = Board::whereHas('boardUsers', function ($query) use ($user, $role_id, $board_id) {
            $query->where('user_id', $user->id);
            $query->where('role_id', $role_id);
            $query->where('board_id', $board_id);
        })
            ->get();

        if (!$boards->count()) {
            session()->flash('errorNoAccess', 'Что то произошло эмпирическое, или У вас нет доступа к этой доске');
            return redirect()->back();
        }

        UserController::setCurentBoard($user->id, $board_id);
        UserController::updateRole($user->id, $role_id);

    }

    public static function goto($board_id, $role_id)
    {

        self::enterAs($board_id, $role_id);

        return redirect()->route('leed', ['board_id' => $board_id]);

//        dd($boards->toArray());
//        dd([$board_id,$role_id,$user->id]);

    }

    public static function CreateBoard($user_id, $new_board_name = null)
    {

        $user = User::with('boardUser')->select('id')->findOrFail($user_id);

//        dd($user->toArray());

        Board::create(['name' => ($new_board_name ?? 'Новая доска ' . date('ymdHis'))]);

//        $user->boardUser()->create([
//            'board_id' => $user->board()->create([
//                'name' => $new_board_name ?? 'Новая доска '.date('ymdHis'),
////                'color' => '#000000',
//            ])->id,
//        ]);

        dd($user->toArray());

    }

    /**
     * получаем список связей пользоатель доска
     * @param $board_id
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getBoardUser($board_id = null, $user_id = null, $type = 'mini')
    {
        $return = BoardUser::with([
            'board' => function ($query) use ($board_id, $user_id, $type) {
                $query->withTrashed();
                if ($type == 'mini') {
                    $query->select('id', 'name', 'deleted_at');
                }
            },
            'user' => function ($query) use ($board_id, $user_id, $type) {
                $query->withTrashed();
                if (!empty($user_id)) {
                    $query->whereId($user_id);
                }
                if ($type == 'mini') {
                    $query->select('id', 'name', 'phone_number', 'deleted_at');
                }
            },
//            'role' => function ($query)  use ($board_id,$user_id,$type) {
//                $query->withTrashed();
//                if( $type == 'mini' ){$query->select('id','name','deleted_at');}
//            },
        ])
            ->where(function ($query) use ($board_id) {
                if (!empty($board_id)) {
                    $query->whereBoardId($board_id);
                }
            })

//            ->distinct('user_id')
//            ->pluck('user_id')
//            ->groupBy('user_id')
//            ->select('board_users.*', DB::raw('MIN(board_users.id) as id'))

            ->get();
        return $return;
    }

    public static function delete(Board $board)
    {
        $board->delete();
        return redirect()->back();
    }

    public static function getRolesBoard($board_id)
    {
        $board_roles = Board::find($board_id)->roles;
        return $board_roles;
    }

    public static function getCurrentBoard($user_id, $new_board_id = null)
    {

        $user = User::with([
            'boardUser',
            'boardUser.board',
//            'boardUser.board' => function($query) use ($new_board_id) {
//                $query->whereId($new_board_id);
//            },
            'boardUser.role',
        ])->findOrFail($user_id);

//            dd($user->toArray());

        if (!empty($user->boardUser)) {
            foreach ($user->boardUser as $board) {
                if (empty($new_board_id) || $board->board_id == $new_board_id) {
                    $user->current_board_id = $board->board_id;
                    $user->save();
//                    $user->assignRole($board->role_id);
                    $user->roles()->sync([$board->role_id]);
                    return $board->board_id;
                }
            }
//        }elseif (sizeof($user->boardUser) == 1) {
//            $user->current_board_id = $user->boardUser[0]->board_id;
//            $user->save();
//            $user->assignRole($user->boardUser[0]->role->id);
//            return $user->boardUser[0]->id;
        }

        return false;
    }
}
