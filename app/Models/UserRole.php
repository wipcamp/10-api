<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
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

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'id', 'role_id');
    }
}
