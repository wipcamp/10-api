<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalsDenorm extends Model
{
    protected $table = 'evals_denorm';

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function profile_registrant()
    {
        return $this->belongsTo('App/Models/ProfileRegistrant', 'user_id', 'user_id');
    }
}
