<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $fillable = [
        'name', 'sub_process_id'
    ];

    public function areas()
    {
        return $this->hasMany('App\Area');
    }

    public function headquarter()
    {
        return $this->belongsTo('App\Headquarter');
    }

    public function file()
    {
        return $this->belongsTo('App\IpercFile','iperc_file_id','id');
    }
}
