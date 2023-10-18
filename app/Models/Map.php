<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Map extends Model
{
    // Map class to map Database columns to CSV header columns
    protected $fillable = [
        'column_header', 'csv_header', 'table_name', 'filename'
    ];
    protected $primaryKey = 'maps_id';
}
