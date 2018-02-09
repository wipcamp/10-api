<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRegistrant extends Model
{
    protected $fillable = [
        'addr_prov', 'addr_dist', 'telno_personal', 
        'edu_name', 'edu_lv', 'edu_major', 'edu_gpax',
        'known_via', 'activities', 'skill_computer', 'past_camp',
        'parent_relation', 'telno_parent'
    ];

    public function profile() {
        return $this->belongsTo('App/Profile', 'id', 'user_id');
    }

    public function evals_denorm()
    {
        return $this->hasOne('App/EvalsDenorm', 'user_id', 'user_id');
    }
}
