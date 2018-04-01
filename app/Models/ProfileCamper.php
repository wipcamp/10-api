<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileCamper extends Model
{
    protected $fillable = [
        'user_id', 'section_id'
    ];

    public function profile()
    {
      return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }

    public function profile_registrant()
    {
      return $this->hasOne('App\Models\ProfileRegistrant', 'user_id', 'user_id');
    }

    public function confirm_camper()
    {
      return $this->hasOne('App\Models\ConfirmCamper', 'user_id', 'user_id');
    }

    public function camp_section() {
        $this->belongsTo('App\Models\CampSection', 'id', 'section_id');
    }

    public function exams() {
        $this->hasMany('App\Models\Exam', 'user_id', 'user_id');
    }
}
