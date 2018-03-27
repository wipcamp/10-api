<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function problem()
    {
        return $this->belongsTo('App\Models\Problem', 'id', 'problem_id');
    }

    public function role_team()
    {
        return $this->belongsTo('App\Models\RoleTeam', 'id', 'role_team_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'assigned_id');
    }
}
