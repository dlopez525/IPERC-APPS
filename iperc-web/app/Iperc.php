<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iperc extends Model
{
    use SoftDeletes;
    
    protected $table = 'ipercs';

    public function danger()
    {
        return $this->belongsTo('App\Danger');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function risk()
    {
        return $this->belongsTo('App\Risk');
    }

    public function dangerDescription()
    {
        return $this->belongsTo('App\DangerDescription');
    }

    public function consequence()
    {
        return $this->belongsTo('App\Consequence');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function file()
    {
        return $this->belongsTo('App\IpercFile','iperc_file_id', 'id');
    }
}
