<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRoleRepositoryInterface;

class UserRoleController extends Controller
{
    protected $userRoleRepo;

    public function __construct(UserRoleRepositoryInterface $ur) {
        $this->userRoleRepo = $ur;
    }

    public function getByUserId($id) {
        $data = $this->userRoleRepo->getByUserId($id);
        return json_encode($data);
    }
}
