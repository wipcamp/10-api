<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $hidden = [
        'id', 'name'
    ];

    public function provider_users() {
        return $this->hasMany('App\Models\ProviderUser');
    }
}
