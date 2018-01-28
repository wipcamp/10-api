<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $guarded = [
      'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
      'id'
    ];
}
