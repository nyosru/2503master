<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public static function setBoardRole($user_id, $board_id, $role_id): void
    {

// Делаем проверку (можно добавить проверку подписи Telegram)
        $set = \App\Models\BoardUser::updateOrCreate(
            [
                'board_id' => $board_id,
                'user_id' => $user_id,
                'role_id' => $role_id
            ]
//        ,
//            [
//                'email' => $data['id'] . '@telegram.ru',
//                'password' => bcrypt($data['id']),
//                'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
//                'username' => $data['username'] ?? null,
//                'avatar' => $data['photo_url'] ?? null,
//            ]
        );

        self::updateRole($user_id, $role_id);
        self::setCurentBoard($user_id, $board_id);

//        dd($set);

    }

    /**
     * установить роль у пользователя в базе данных (стереть остальные)
     * @param $userId
     * @param $roleId
     * @return void
     */
    public static function updateRole($userId, $roleId)
    {
        $user = User::find($userId);

        if ($user && Role::find($roleId)) {
            $user->roles()->sync([$roleId]); // Используем sync для отвязки всех и добавления новой роли
//            $this->new_role_message[$userId] = "Новая роль: " . Role::find($roleId)->name;
        }
//        else {
//            $this->new_role_message[$userId] = "Ошибка назначения роли.";
//        }

    }

    public static function setCurentBoard($userId, $boardId)
    {
        $user = User::find($userId);
        $user->current_board_id = $boardId;
        $user->save();
//        User::where('id', $userId)->update(['current_board_id' => $boardId]);
    }

    public static function setPhoneNumberFromTelegaId($user_telega_id, $phone_number): void
    {
        User::where('telegram_id', $user_telega_id)->update(['phone_number' => $phone_number]);
    }
}
