<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalQuestionCriteria extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function eval_question()
    {
        return $this->belongsTo('App\Models\EvalQuestion', 'id', 'question_id');
    }
}
