<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemType extends Model
{
    protected $guarded = [
        'id', 'name', 'created_at', 'updated_at',
    ];

    public function problem()
    {
        return $this->hasMany('App\Models\Problem');
    }
}
