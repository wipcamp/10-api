<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampSection extends Model
{
    public $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public $hidden = [
        'name'
    ];

    public function section_scores() {
        return $this->hasMany('App\Models\SectionScore', 'section_id');
    }

    public function profile_campers() {
        return $this->hasMany('App\Models\ProfileCamper', 'section_id');
    }
}
