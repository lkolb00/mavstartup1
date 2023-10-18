<?php


namespace App\Models;

use Illuminate\Database\Eloquent\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Log;

/**
@mixin \Eloquent
 */

class MapTable extends Model
{
    // Map class to map Database columns to CSV header columns
    protected $table = "map_tables";
    protected $fillable = [
        'csv_name',
        'local_filename',
        'year',
        'job_id'
    ];


    public function Job() {
        return $this->hasOne('App\Models\Job');
    }
}
