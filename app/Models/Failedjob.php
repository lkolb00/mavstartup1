<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Failedjob extends Model
{
    protected $table = "failed_jobs";

    protected $fillable=[
        'id',
        'queue',
        'payload',
        'attempts',
        'reserved_at',
        'available_at',
        'created_at'
    ];
}










