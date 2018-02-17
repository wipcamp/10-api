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

    public function createWipper($id) {
        if (!is_numeric($id)) {
            return response()->json([
                'status' => 200,
                'error' => 'Invalid Data.'
            ]);
        }
        $roleId = $this->roleRepo->getIdByName('camp_staffs_senior');
        $data = $this->roleRepo->createStaff($id, $roleId);
        return response()->json($data);
    }
}
