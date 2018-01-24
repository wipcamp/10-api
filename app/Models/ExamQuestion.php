<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function exam_choices()
    {
        return $this->hasMany('App\Models\ExamChoice', 'question_id');
    }
}
