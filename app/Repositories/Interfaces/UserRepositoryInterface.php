<?php

namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface {
    public function all();
    public function find($id);
    public function store($data);
    public function update($data, $user);
    public function softDelete($user);
    public function forceDelete($user);
    public function assignRole($roleInputs, $user);
}
