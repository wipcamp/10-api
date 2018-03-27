<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'is_solve', 'not_solve',
    ];

    public function problem_type()
    {
        return $this->belongsTo('App\Models\ProblemType', 'id', 'problem_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'report_id');
    }

    public function prioritys()
    {
        return $this->belongsTo('App\Models\Priority', 'id', 'priority_id');
    }

    public function assign()
    {
        return $this->hasMany('App\Models\Assign');
    }
}
