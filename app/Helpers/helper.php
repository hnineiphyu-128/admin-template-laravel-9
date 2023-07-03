<?php

namespace App\Helpers;

use App\Models\App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class helper
{
    /**
     * check user has given role by role id
     * @param $role_id, $user_roles
     */
    static public function hasRole($role_id, $user_roles) : bool {
        foreach ($user_roles as $key => $user_role) {
            if ($user_role->id == $role_id) {
                return true;
            }
        }
        return false;
    }
}
