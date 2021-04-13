<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danger extends Model
{
    protected $fillable = [
        'name','headquarter_id','img'
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task')->distinct();
    }

    public function description()
    {
        return $this->hasMany('App\DangerDescription');
    }
}
