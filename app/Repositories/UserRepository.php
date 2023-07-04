<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function all() : Collection
    {
        if (Auth::user()->is_administrator) {
            return User::with(['roles'])->latest()->get();
        } else {
            return User::with(['roles'])->whereRelation('roles', 'id', '<>', 1)->latest()->get();
        }
    }

    public function find($id)
    {
        return $this->all()->find($id);
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function update($data, $user)
    {
        return $user->update($data);
    }

    public function softDelete($user)
    {
        $user->delete();
    }

    public function forceDelete($user)
    {
        $user->forceDelete();
    }

    public function restore($id)
    {
        $this->all()->withTrashed()->find($id)->restore();
    }

    public function restoreAll()
    {
        $this->all()->onlyTrashed()->restore();
    }

    public function assignRole($roleInputs, $user)
    {
        $roles = [];
        if(count($roleInputs) > 0) {
            foreach ($roleInputs as $key => $value) {
                array_push($roles, $value);
            }
        }
        $user->roles()->sync($roles);
    }
}
