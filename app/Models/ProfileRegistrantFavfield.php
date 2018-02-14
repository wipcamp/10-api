<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRegistrantFavfield extends Model
{
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function profile() {
        return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }
}
