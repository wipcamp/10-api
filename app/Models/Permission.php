<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id', 'name'
    ];

    public function role_permissions() {
        return $this->hasMany('App\Models\RolePermission');
    }
}
