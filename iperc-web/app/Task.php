<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'is_routine', 'activity_id'
    ];

    public function dangers()
    {
        return $this->belongsToMany('App\Danger')->distinct();
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }
}
