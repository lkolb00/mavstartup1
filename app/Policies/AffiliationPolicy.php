<?php

namespace App\Policies;

use App\Models\Affiliation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AffiliationPolicy extends MavBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        // Everyone is allowed to viewAny (meaning index/browse) all/any models
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Affiliation $affiliation): bool
    {
        // Everyone is allowed to view (meaning index/browse) a specific model
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Affiliation $affiliation): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Affiliation $affiliation): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Affiliation $affiliation): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Affiliation $affiliation): bool
    {
        return $user->isAdministrator();
    }
}
