<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [

        'year','active'

    ];

    public function year(){
        return $this->belongsTo('App\Models\Year');
    }
}
