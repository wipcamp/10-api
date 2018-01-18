<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFormat extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id', 'name', 'mime_type'
    ];

    public function documents() {
        return $this->hasMany('App/Models/DocumentFormat', 'format_id');
    }
}
