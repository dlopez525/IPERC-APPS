<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consequence extends Model
{
    protected $fillable = [
        'name', 'danger_description_id'
    ];

    public function description()
    {
        return $this->belongsTo('App\DangerDescription','danger_description_id','id');
    }
}
