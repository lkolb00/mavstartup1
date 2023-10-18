<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Zizaco\Entrust\Traits\EntrustUserTrait;
use Log;


class Student extends Model
{


    protected $fillable=[
        //'Admission_ID',
        'id',
        'school_id',
        'year',
        'total_studentcount_1',
        'undrgradstudentcount_2',
        'gradstudentcount_4',
        'inst_act_ugcredit_hrs',
        'inst_act_gradcredit_hrs',
        'inst_activity_type',
        'under_certi_award_level1',
        'under_certi_award_level2',
        'under_certi_award_level4',
        'under_degree_award_level3',
