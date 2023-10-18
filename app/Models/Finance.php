<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Zizaco\Entrust\Traits\EntrustUserTrait;
use Log;

class Finance extends Model
{
    protected $fillable=[
        //'Finance_ID',
        'id',
        'school_id',
        'year',
        'public_total_salary_wage',
        'privateprofit_total_salary_wage',
        'private_nonprofit_total_salary_wage',
    ];
    protected $primaryKey = 'id';

    public static function getTableName() {
        return (new static)->getTable();
    }

    public function school() {
        return $this->belongsTo('App\School');
    }
