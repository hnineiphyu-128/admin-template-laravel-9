<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{

    /**
     * get roles id array
     * @param $request
     */
    public static function getRoleIds($role_title)
    {
        $roles = [];
        if ($role_title) {
            array_push($roles, (new self)->getRoleId($role_title));
        }

        return $roles;
    }

    /**
     * get role id by role title
     * @param $role_title
     */
    public static function getRoleId($role_title)
    {
        return Role::where('title', $role_title)->first()->id;
    }

}
