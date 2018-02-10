<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRegistrant extends Model
{
    protected $guarded = [
        'first_name', 'last_name', 'first_name_en', 'last_name_en', 'nickname',
        'gender_id', 'citizen_id', 'religion_id', 'birth_at',
        'blood_group', 'congenital_diseases', 'allergic_foods', 'congenital_drugs'
    ];

    public function profile() {
        return $this->belongsTo('App\Models\Profile', 'id', 'user_id');
    }

    public function evals_denorm()
    {
        return $this->hasOne('App\Models\EvalsDenorm', 'user_id', 'user_id');
    }
}
