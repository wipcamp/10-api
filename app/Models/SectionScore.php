<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionScore extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function camp_section() {
        return $this->belongsTo('App\Models\CampSection', 'section_id');
    }
}
