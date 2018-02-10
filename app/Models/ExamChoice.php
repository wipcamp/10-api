<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamChoice extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function exam_question()
    {
        return $this->belongsTo('App\Models\ExamQuestion', 'id', 'question_id');
    }
    
    public function exams()
    {
        return $this->hasMany('App\Models\Exam', 'choice_id');
    }
}
