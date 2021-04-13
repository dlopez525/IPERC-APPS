<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProcess extends Model
{
    protected $fillable = [
        'name', 'zone_id'
    ];

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }
}
