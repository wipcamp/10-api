<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function profile()
    {
      return $this->belongsTo('App\Models\Profile', 'user_id', 'user_id');
    }

    public function document_type()
    {
      return $this->belongsTo('App\Models\DocumentType', 'type_id', 'id');
    }

    public function document_format()
    {
      return $this->belongsTo('App\Models\DocumentFormat', 'id', 'format_id');
    }
}
