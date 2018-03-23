<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'creater_id');
    }

    public function role_team()
    {
        return $this->belongsTo('App\Models\RoleTeam', 'id', 'role_team_id');
    }
}
