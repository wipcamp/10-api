<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalQuestion extends Model
{
    protected $fillable = [
        'data'
    ];

    public function eval_question_criterias()
    {
        return $this->hasMany('App\Models\EvalQuestionCriteria', 'question_id');
    }

    public function question_role()
    {
        return $this->belongsTo('App\Models\RoleTeam','question_role_teams','id')
    }

    public function eval_answers()
    {
        return $this->hasMany('App\Models\EvalAnswer', 'question_id');
    }
}
