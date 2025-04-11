<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{

    public static function goto($board_id, $role_id)
    {
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
