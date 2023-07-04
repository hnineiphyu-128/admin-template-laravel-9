<?php

namespace App\Repositories\Interfaces;

Interface RoleRepositoryInterface {
    public function all();
    public function find($id);
    public function store($data);
    public function update($data, $role);
    public function softDelete($role);
    public function forceDelete($role);
    public function assignPermission($permissionInputs, $role);
}
