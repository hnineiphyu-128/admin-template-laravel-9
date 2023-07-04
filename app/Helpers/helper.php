<?php

namespace App\Helpers;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * get role ids if auth user
     */
    static public function getRoleIds() {
        return DB::table('role_user')->where('user_id', Auth::id())->pluck('role_id')->toArray();
    }

    /**
     * get permission ids of auth user's roles
     * @param  array $user_roles
     */
    static public function getPermissionIds($user_roles) {
        return DB::table('permission_role')->whereIn('role_id', $user_roles)->pluck('permission_id')->toArray();
    }

    /**
     * get same roles users
     * @param  array $user_roles
     */
    static public function getSameRolesUsers($user_roles) {
        return User::whereHas('roles', function ($query) use ($user_roles) {
            $query->whereIn('id', $user_roles);
        })
        ->where('id', '<>', auth()->user()->id)
        ->get();
    }
}
