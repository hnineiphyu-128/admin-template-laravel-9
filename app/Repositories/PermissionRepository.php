<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all() : Collection
    {
        if (Auth::user()->is_administrator) {
            return Permission::latest()->get();
        } else {
            return Permission::where('title', '<>', 'permission_create')
                                        ->where('title', '<>', 'permission_edit')
                                        ->where('title', '<>', 'permission_delete')
                                        ->latest()->get();
        }
    }

    public function find($id)
    {
        return $this->all()->find($id);
    }

    public function store($data)
    {
        return Permission::create($data);
    }

    public function update($data, $permission)
    {
        return $permission->update($data);
    }

    public function softDelete($permission)
    {
        $permission->delete();
    }

    public function forceDelete($permission)
    {
        $permission->forceDelete();
    }

    public function restore($id)
    {
        $this->all()->withTrashed()->find($id)->restore();
    }

    public function restoreAll()
    {
        $this->all()->onlyTrashed()->restore();
    }

    public function groupBy()
    {
        if (Auth::user()->is_administrator) {
            return Permission::get()->groupBy(function($permission) {
                return explode('_', $permission->title)[0];
            });
        } else {
            return Permission::whereNotIn('title', ['permission_create', 'permission_edit', 'permission_delete'])->get()->groupBy(function($permission) {
                return explode('_', $permission->title)[0];
            });
        }
    }
}
