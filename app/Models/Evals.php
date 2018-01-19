<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evals extends Model
{
    protected $table = 'evals';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
