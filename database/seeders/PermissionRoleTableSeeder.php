<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $administrator_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($administrator_permissions->pluck('id'));

        $admin_permissions = $administrator_permissions->filter(function ($permission) {
            return $permission->title != 'permission_create' && $permission->title != 'permission_edit' && $permission->title != 'permission_delete';
        });
        Role::findOrFail(2)->permissions()->sync($admin_permissions);

        $manager_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(3)->permissions()->sync($manager_permissions);

        $staff_permissions = $manager_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_';
        });
        Role::findOrFail(4)->permissions()->sync($staff_permissions);

        $user_permissions = $manager_permissions->filter(function ($permission) {
            return $permission->title == 'profile_password_edit';
        });
        Role::findOrFail(5)->permissions()->sync($user_permissions);
    }
}
