<?php

namespace App\Policies;

use App\Models\PrimaryMedicalForm;
use App\Models\User;

class PrimaryMedicalFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-primary-medical-form');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrimaryMedicalForm $primaryMedicalForm): bool
    {
        return $user->hasPermissionTo('view-primary-medical-form');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-primary-medical-form');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrimaryMedicalForm $primaryMedicalForm): bool
    {
        return $user->hasPermissionTo('update-primary-medical-form');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrimaryMedicalForm $primaryMedicalForm): bool
    {
        return $user->hasPermissionTo('delete-primary-medical-form');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrimaryMedicalForm $primaryMedicalForm): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrimaryMedicalForm $primaryMedicalForm): bool
    {
        return $user->hasPermissionTo('delete-primary-medical-form');
    }
}
