<?php
/**
 * Mav Base Policy
 *
 * @category   Mav Base Policy
 *
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2023-2024
 * @license    The MIT License (MIT)
 *
 * @version    GIT: $Id$
 *
 * @since      File available since Release 1.0.0
 */

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class MavBasePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdministrator()) {
            return true;
        }

        return null;
    }
}

