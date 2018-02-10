<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_id'
    ];

    public function user_roles()
    {
        return $this->hasMany('App\Models\UserRole');
    }

    public function provider_users()
    {
        return $this->hasMany('App\Models\ProviderUser');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function evals()
    {
        return $this->hasMany('App\Models\Evals', 'checker_id');
    }

    public function problem()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
