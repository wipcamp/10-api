<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'topic', 'problem_type_id', 'description', 'report_id', 'is_solve', 'not_solve',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function problem_type()
    {
        return $this->belongsTo('App\Model\ProblemType', 'id', 'problem_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'report_id');
    }
}
