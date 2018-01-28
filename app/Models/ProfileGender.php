<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileGender extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id', 'name'
    ];

    public function profiles()
    {
        return $this->hasMany('App\Models\Profile', 'gender_id');
    }
}
