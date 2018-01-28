<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileReligion extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id', 'name'
    ];

    public function profiles()
    {
        $this->hasMany('App\Models\Profile', 'religion_id');
    }
}
