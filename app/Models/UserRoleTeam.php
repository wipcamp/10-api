<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleTeam extends Model
{
    protected $guarded = [
        'id', 'created_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function role_team()
    {
        return $this->belongsTo('App\Models\RoleTeam', 'id', 'role_team_id');
    }
}
