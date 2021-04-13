<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'job_position_id'
    ];

    public function subProcess()
    {
        return $this->belongsTo('App\SubProcess');
    }
}
