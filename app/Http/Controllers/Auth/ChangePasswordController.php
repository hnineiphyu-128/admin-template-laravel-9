<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Permission;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_roles = helper::getRoleIds();
        $users = helper::getSameRolesUsers($user_roles);
        $permissionIds = helper::getPermissionIds($user_roles);
        $permissions = Permission::whereIn('id', $permissionIds)->get();

        return view('auth.passwords.edit', compact('users', 'permissions'));
    }

    public function update(UpdatePasswordRequest $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            auth()->user()->update($request->validated());
            return redirect()->route('profile.password.edit')->with('success', __('global.change_password_success'));
        }
        return redirect()->route('profile.password.edit')->with('error', __('global.invalid_old_password'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        return redirect()->route('profile.password.edit')->with('success', __('global.update_profile_success'));
    }

    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();
        $imagePath = User::moveImage($request['profile_image'], User::IMAGE_PATH, 'profile_image', 'users');
        $user->profile_image = $imagePath;
        $user->save();

        return redirect()->route('profile.password.edit')->with('success', __('global.update_profile_success'));
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        return redirect()->route('login')->with('success', __('global.delete_account_success'));
    }
}
