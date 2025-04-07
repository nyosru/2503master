<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function setPhoneNumberFromTelegaId($user_telega_id,$phone_number): User
    {
        return User::where('telegram_id',$user_telega_id)->update(['phone_number'=>$phone_number]);
    }
}
