<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evals extends Model
{
    protected $table = 'evals';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function eval_answer()
    {
        return $this->belongsTo('App\Models\EvalAnswer', 'id', 'id');
    }

    public function eval_criteria()
    {
        return $this->belongsTo('App\Models\EvalCriteria', 'id', 'criteria_id');
    }

    public function eval_checker()
    {
        return $this->belongsTo('App\User', 'id', 'checker_id');
    }
}
