<?php

/**
 * StateAbbreviation Model
 *
 * @category   StateAbbreviation
 * @package    PBBT-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2018
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StateAbbreviation
 * @package App
 */
class StateAbbreviation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'state_abbreviations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'description' ];

}














