<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            /** @var User $user */
            $user = User::create($data);
            if(!empty($data['profile_image']))
            {
                $imagePath = User::moveImage($data['profile_image'], User::IMAGE_PATH, 'profile_image', 'users');
                $user->profile_image = $imagePath;
                $user->save();
            } else {
                $user->profile_image = '/user-avatar.png';
                $user->save();
            }
            File::deleteDirectory(public_path('uploads/temp/users/'. Auth::id()));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$e->getMessage()]));
        }

        return $user;
    }

    public function update($data, $user)
    {
        try {
            DB::beginTransaction();

            if(!empty($data['profile_image'])) {
                $profile_image = $data['profile_image'];
                unset($data['profile_image']);
            }
            $user->update($data);
            if(!empty($profile_image) && is_null($user->profile_image))
            {
                $imagePath = User::moveImage($profile_image, User::IMAGE_PATH, 'profile_image', 'users');
                if (File::exists($user->profile_image)) {
                    File::delete($user->profile_image);
                }
                $user->profile_image = $imagePath;
                $user->save();
            }
            File::deleteDirectory(public_path('uploads/temp/users/'. Auth::id()));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$e->getMessage()]));
        }

        return $user;
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
