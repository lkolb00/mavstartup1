<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;

// use Zizaco\Entrust\Traits\EntrustUserTrait;

class Job extends Model
{
    //
    protected $fillable=[
        'id',
        'queue',
        'payload',
        'attempts',
        'reserved_at',
        'available_at',
        'created_at'
    ];


    public function map_table()
    {
        return $this->hasOne('App\map_table','job_id');
    }
}
