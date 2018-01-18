<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileCamper extends Model
{
    protected $fillable = [
        'user_id', 'section_id'
    ];

    public function profile() {
        $this->belongsTo('App/Profile', 'user_id', 'user_id');
    }

    public function camp_section() {
        $this->belongsTo('App/CampSection', 'id', 'section_id');
    }
}
