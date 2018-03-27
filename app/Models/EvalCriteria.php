<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalCriteria extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function eval_question_criterias() {
        return $this->hasMany('App\Models\EvalQuestionCriteria', 'criteria_id');
    }

    public function evals()
    {
        return $this->hasOne('App/Model/Evals', 'id');
    }

    public function eval_question()
    {
        return $this->belongsTo('App/Model/EvalQuestion', 'id' ,'question_id');
    }
}
