<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleTeam extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'id', 'name',
    ];

    public function user_role_teams()
    {
        return $this->hasMany('App\Models\UserRoleTeam');
    }

    public function timetable()
    {
        return $this->hasMany('App\Models\Timetable');
    }
}
