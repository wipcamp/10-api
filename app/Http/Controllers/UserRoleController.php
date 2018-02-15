<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRoleRepositoryInterface;

class UserRoleController extends Controller
{
    protected $userRoleRepo;

    public function __construct(UserRoleRepositoryInterface $userRole) {
        $this->userRoleRepo = $userRole;
    }

    public function getByUserId($userId) {
        $data = $this->userRoleRepo->getByUserId($userId);
        return json_encode($data);
    }
}
