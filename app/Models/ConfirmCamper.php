<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmCamper extends Model
{
    protected $guarded = [
      'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
      'id'
    ];

    public function profile()
    {
      return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }

}
