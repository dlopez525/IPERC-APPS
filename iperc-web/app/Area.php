<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name', 'headquarter_id'
    ];

    public function zones()
    {
        return $this->hasMany('App\Zone');
    }

    public function JobPosition()
    {
        return $this->belongsTo('App\JobPosition');
    }
}
