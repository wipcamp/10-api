<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalAnswer extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function profile() {
        return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }

    public function eval_question() {
        return $this->belongsTo('App\Models\EvalQuestion', 'id', 'question_id');
    }

    public function evals()
    {
        return $this->hasMany('App\Models\Evals', 'answer_id');
    }
}
