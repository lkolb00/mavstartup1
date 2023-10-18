<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarnegieClassification extends Model
{
    protected $table = "carnegie_classifications";
    protected $fillable=[
        'id',
        'school_id',
        'year',
        'carnegie_basic',
        'carnegie_ug_program',
        'carnegie_grad_program',
        'carnegie_ug_profile',
        'carnegie_enroll_profile',
        'carnegie_size_setting',
        'carnegie_classification2000'
    ];
    protected $primaryKey = 'id';
    public static function getTableName() {
        return (new static)->getTable();
    }

    public function school() {
        return $this->belongsTo('App\School');
        //EHLbug: syntax should be: return $this->belongsTo('App\<parent model>', 'foreign_key', 'other_key');
    }
}
