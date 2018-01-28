<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'id', 'name'
    ];

    public function documents()
    {
        return $this->hasMany('App/Models/Document', 'type_id');
    }
}
