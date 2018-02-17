<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'id', 'name',
    ];

    public function user_roles()
    {
        return $this->hasMany('App\Models\UserRole');
    }

    public function role_permissions()
    {
        return $this->hasMany('App\Models\RolePermission');
    }
}
