<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderUser extends Model
{
    protected $guarded = [
        'id', 'expired_at', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'access_token', 'refresh_token', 'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'id', 'provider_id');
    }
}
