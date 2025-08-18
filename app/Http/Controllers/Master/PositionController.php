<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\PermissionSetting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PositionController extends Controller
{

    public function setStartPermissionFromPosition($role_id)
    {

        $permission_start = PermissionSetting::where('for_start', true)->pluck('permission_id');
        $role = Role::find($role_id);

        foreach( $permission_start as $permission ){
            $role->givePermissionTo($permission);
        }

    }

}
