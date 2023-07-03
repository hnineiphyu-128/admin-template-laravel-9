<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\App;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->is_administrator) {
            $users = User::with(['roles'])->latest()->get();
        } else {
            $users = User::with(['roles'])->whereRelation('roles', 'id', '<>', 1)->latest()->get();
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->is_administrator) {
            $roles = Role::get();
        } else {
            $roles = Role::where('id', '<>', 1)->get();
        }

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $user = User::create($request->all());
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->is_administrator) {
            $roles = Role::get();
        } else {
            $roles = Role::where('id', '<>', 1)->get();
        }
        // dd($apps);
        $user->load('roles');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $user->update($request->all());
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
