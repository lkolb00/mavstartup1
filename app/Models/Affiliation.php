<?php

/**
 * Affiliation Model
 *
 * @category   Affiliation
 * @package    PBBT-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2023
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Affiliation
 * @package App
 */
class Affiliation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'affiliations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[ 'name', 'description', 'created_by', 'updated_by' ];

    /**
     * @return mixed
     */
    public static function getTableName(): mixed
    {
        return (new static)->getTable();
    }

    /**
     * Get all the users for an affiliation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
