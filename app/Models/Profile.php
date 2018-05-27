<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $guarded = [
        'addr_prov', 'addr_dist', 'telno_personal', 
        'edu_name', 'edu_lv', 'edu_major', 'edu_gpax',
        'known_via', 'activities', 'skill_computer', 'past_camp',
        'parent_relation', 'telno_parent'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id', 'id'); //(Model,localkey,DestinationKey)
    }

    public function profile_gender()
    {
        return $this->belongsTo('App\Models\ProfileGender', 'gender_id', 'id');
    }

    public function profile_religion()
    {
        return $this->hasOne('App\Models\ProfileReligion', 'id', 'religion_id');
    }

    public function profile_registrant()
    {
        return $this->hasOne('App\Models\ProfileRegistrant', 'user_id', 'user_id');
    }

    public function profile_registrant_favfields()
    {
        return $this->hasMany('App\Models\ProfileRegistrantFavfield', 'user_id', 'user_id');
    }

    public function profile_camper()
    {
        return $this->hasOne('App\Models\ProfileCamper', 'user_id', 'user_id');
    }

    public function profile_staff()
    {
        return $this->hasOne('App\Models\ProfileStaff', 'user_id', 'user_id');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'user_id', 'user_id');
    }

    public function eval_answers()
    {
        return $this->hasMany('App\Models\EvalAnswer', 'user_id', 'user_id');
    }
}
