<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\common;
use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\App;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public $userRepository, $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users  = $this->userRepository->all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = $this->roleRepository->all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->store($request->all());
        if(count($request->input('roles', [])) > 0) {
            $this->userRepository->assignRole($request->input('roles'), $user);
        }

        return redirect()->route('admin.users.index')->with('success', 'User Create Successfully!');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $this->roleRepository->all();

        $user->load('roles');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($request->all(), $user);
        if(count($request->input('roles', [])) > 0) {
            $this->userRepository->assignRole($request->input('roles'), $user);
        }

        return redirect()->route('admin.users.index')->with('success', 'User Update Successfully!');
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

        $this->userRepository->softdelete($user);

        return redirect()->back()->with('success', 'User Delete Successfully!');
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // Dropzone Media Image
    public function storeMedia(Request $request)
    {
        $path = public_path('uploads/temp/users/'. Auth::id());

        $file = $request->file('file');

        $response = common::storeMedia($path, $file);

        return $response;
    }

    public function removeMedia(Request $request)
    {
        $type = $request->type;
        $user_id = $request->model_id;
        $file_name = $request->file_name;
        $model = 'App\Models\User';

        $response = common::removeMedia($model, $user_id, $type, $file_name);

        return $response;
    }
}
