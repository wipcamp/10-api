<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalCriteria extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function eval_criterias() {
        return $this->hasMany('App\Models\EvalQuestionCriteria', 'criteria_id');
    }
}
