<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'first_name_en', 'last_name_en', 'nickname',
        'gender_id', 'citizen_id', 'religion_id', 'birth_at',
        'blood_group', 'congenital_diseases', 'allergic_foods', 'congenital_drugs'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function profile_gender()
    {
        return $this->belongsTo('App\Models\ProfileGender', 'id', 'gender_id');
    }

    public function profile_religion()
    {
        return $this->belongTo('App\Models\ProfileReligion', 'id', 'religion_id');
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
