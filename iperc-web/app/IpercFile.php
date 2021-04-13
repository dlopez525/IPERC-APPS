<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpercFile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function iperc()
    {
        return $this->hasMany('App\Iperc');
    }
}
