<?php

namespace App\Http\Controllers;

use App\Models\BoardUser;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    /**
     * сделать вход по пригрлашению
     * @param $id
     * @return void
     */
    function join($id)
    {

        $user = Auth::user();
        try {
            $invitation = Invitation::whereId($id)->wherePhone($user->phone_number)->firstOrFail();

            // Создание записи
            BoardUser::create([
                'board_id' => $invitation->board_id,
                'user_id' => $user->id,
                'role_id' => $invitation->role_id,
            ]);

            $invitation->delete();

            // Уведомление об успешном добавлении
            session()->flash('inviteMessage', 'Запись успешно добавлена!');

            return redirect()->route('leed.goto',
                [
                    'board_id' => $invitation->board_id,
                    'role_id' => $invitation->role_id
                ]
            );

//            dd($user2);
        } catch (\Exception $e) {
            if( strpos($e->getMessage(),'No query results') !== false ) {
                session()->flash('inviteWarning', 'ошибка '.__LINE__.', что то пошло не так');
            }else {
                dd($e);
            }
        }

        return redirect()->back();

    }

//    /**
//     * Сохраняет новое приглашение.
//     */
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'board_id' => 'required|exists:boards,id',
//            'phone' => 'required|string|max:20',
//            'role_id' => 'required|exists:roles,id',
//            'user_id' => 'nullable|exists:users,id',
//        ]);
//
//        Invitation::create($validated);
//
//        return redirect()->back()->with('success', 'Приглашение успешно создано.');
//    }


}
