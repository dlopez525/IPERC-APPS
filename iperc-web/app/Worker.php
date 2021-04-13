<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name', 'sap', 'headquarter_id',
    ];
    
    public function headquarter()
    {
        return $this->belongsTo('App\Headquarter');
    }
}
