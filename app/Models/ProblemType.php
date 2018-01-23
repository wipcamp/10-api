<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemType extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'id', 'name',
    ];

    public function problem()
    {
        return $this->hasMany('App\Models\Problem');
    }
}
