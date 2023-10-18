<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Zizaco\Entrust\Traits\EntrustUserTrait;
use Log;

class Employee extends Model
{
    //

    protected $fillable=[
        'id',
        'school_id',
        'year',
        'admin_profstaff_management',
        'admin_profstaff_business',
        'admin_profstaff_comp',
        'admin_profstaff_comunityservice',
        'admin_profstaff_healthcare',
        'admin_profstaff_ofcadmin',
        'non_instn_acad_staff_research',
        'non_instn_acad_staff_pub_service',
        'non_instn_acad_staff_library',
        'instruction_staff',
        'non_admin_service_staff_service',
        'non_admin_service_staff_sales',
