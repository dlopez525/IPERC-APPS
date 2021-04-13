<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DangerDescription extends Model
{
    protected $fillable = [
        'name', 'event', 'danger_id'
    ];

    public function danger()
    {
        return $this->belongsTo('App\Danger');
    }
}
