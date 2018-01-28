<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $hidden = [
        'id', 'role_id', 'permission_id'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'id', 'role_id');
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission', 'id', 'permission_id');
    }
}
