<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

Interface PermissionRepositoryInterface {
    public function all();
    public function find($id);
    public function store($data);
    public function update($data, $permission);
    public function softDelete($permission);
    public function forceDelete($permission);
    public function groupBy();
}
