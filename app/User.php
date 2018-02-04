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
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    public function user_roles()
    {
        return $this->hasMany('App\UserRole');
    }

    public function provider_users()
    {
        return $this->hasMany('App\ProviderUser');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function evals()
    {
        return $this->hasMany('App/Model/Evals', 'checker_id');
    }

    public function problem()
    {
        return $this->hasMany('App\Models\Problem');
    }
}
