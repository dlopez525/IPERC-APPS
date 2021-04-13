<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    protected $fillable = [
        'name',
    ];

    public function jobPositions()
    {
        return $this->hasMany('App\JobPosition');
    }

    public function files()
    {
        return $this->hasMany('App\IpercFile');
    }
}
