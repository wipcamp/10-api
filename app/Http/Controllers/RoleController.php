<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepo;

    public function __construct(RoleRepositoryInterface $role) {
        $this->roleRepo = $role;
    }

    public function getByName($name) {
        $data = $this->roleRepo->getIdByName($name);
        return json_encode($data);
    }
}
