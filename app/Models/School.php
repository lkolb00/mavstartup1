<?php

namespace App\Models;

use App\Scopes\SchoolNameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

// use Zizaco\Entrust\Traits\EntrustUserTrait;

class School extends Model
{
    protected $fillable=[
        //'School_Id',
        'id',
        'unitid',
        'name',
        'address',
        'city',
        'state',
        'zip',
        'fips_state_code',
        'geo_location',
        'admin_name',
        'admin_title',
        'telephone_number',
        'emp_id',
        'opeid',
        'ope_flag',
        'school_url',
        'admission_url',
        'finance_url',
        'online_app_url',
        'netprice_calcurl',
        'sector',
        'institution_level',
        'institution_control',
        'highestlevel_offering',
        'ug_offering',
        'grad_offering',
        'highestdegree_offered',
        'degreegranting_status',
        'historical_blackCollege',
        'hospital',
        'grant_medicaldegree',
        'tribal_college',
        'degree_urbanization',
        'open_public',
        'mergedschool_unitid',
        'status',
        'year_deletion_ipeds',
        'closed_date',
        'current_year_active',
        'postsec_indicator',
        'postsec_inst_indicator',
        'postsectitle_instindicator',
        'reporting_method',
        'institutename_alias',
        'institute_category',
        'landgrand_institution',
        'institute_sizecategory',
        'cbsa',
        'cbsa_type',
        'combinedstasticalarea',
        'newengland_citytownarea',
        'multi_inst',
        'multi_inst_name',
        'fips_countycode',
        'county_name',
        'cogressional_distcode',
        'geo_longitude',
        'geo_latitude',
        'created_by',
        'updated_by'
    ];
    protected $primaryKey = 'id';
    public static function getTableName() {
        return (new static)->getTable();
    }

    public function students()
    {
        return $this->hasMany('App\Student');

    }

    public function peergroups()
    {
        return $this->belongsToMany('App\PeerGroup');
    }
    /*public function user()
    {
        return $this->hasMany('App\User');

    } */

    public function employees()
    {
        return $this->hasMany('App\Employee');

    }

    /*Each school has Carnegie Classifications for each year*/
    public function carnegie_classifications()
    {
        return $this->hasMany('App\CarnegieClassification');
        //EHLbug: syntax should be: return $this->hasMany('App\<child model>', 'foreign_key', 'local_key');
        //if foreign_key and local_key not specified, Eloquent assumes foreign_key = parent_id and local_key = id

    }

    public function finance()
    {
        return $this->hasOne('App\Finance');

    }


    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortByName($query)
    {
        return $query->orderBy('name');
    }

}
