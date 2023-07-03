<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->is_administrator) {
            $roles = Role::with(['permissions'])->latest()->get();
        } else {
            $roles = Role::with(['permissions'])->where('id', '<>', 1)->latest()->get();
        }

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->is_administrator) {
            $permissions = Permission::pluck('title', 'id');
        } else {
            $permissions = Permission::whereNotIn('title', ['permission_create', 'permission_edit', 'permission_delete'])->pluck('title', 'id');
        }

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        // dd($request->input('permissions', []));
        $role = Role::create($request->all());
        $permissions = [];
        if(count($request->input('permissions', [])) > 0) {
            foreach ($request->input('permissions') as $key => $value) {
                array_push($permissions, $value);
            }
        }
        $role->permissions()->sync($permissions);

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::user()->is_administrator) {
            $permissions = Permission::pluck('title', 'id');
        } else {
            $permissions = Permission::whereNotIn('title', ['permission_create', 'permission_edit', 'permission_delete'])->pluck('title', 'id');
        }

        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        $permissions = [];
        if(count($request->input('permissions', [])) > 0) {
            foreach ($request->input('permissions') as $key => $value) {
                array_push($permissions, $value);
            }
        }
        $role->permissions()->sync($permissions);
        // $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
