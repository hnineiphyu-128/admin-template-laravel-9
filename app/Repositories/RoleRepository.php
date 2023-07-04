<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleRepositoryInterface
{
    public function all() : Collection
    {
        if (Auth::user()->is_administrator) {
            return Role::with(['permissions'])->latest()->get();
        } else {
            return Role::with(['permissions'])->where('id', '<>', 1)->latest()->get();
        }
    }

    public function find($id)
    {
        return $this->all()->find($id);
    }

    public function store($data)
    {
        return Role::create($data);
    }

    public function update($data, $role)
    {
        return $role->update($data);
    }

    public function softDelete($role)
    {
        $role->delete();
    }

    public function forceDelete($role)
    {
        $role->forceDelete();
    }

    public function restore($id)
    {
        $this->all()->withTrashed()->find($id)->restore();
    }

    public function restoreAll()
    {
        $this->all()->onlyTrashed()->restore();
    }

    public function assignPermission($permissionInputs, $role)
    {
        $permissions = [];
        if(count($permissionInputs) > 0) {
            foreach ($permissionInputs as $key => $value) {
                array_push($permissions, $value);
            }
        }
        $role->permissions()->sync($permissions);
    }
}
