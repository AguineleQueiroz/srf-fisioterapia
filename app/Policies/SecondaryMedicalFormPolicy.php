<?php

namespace App\Policies;

use App\Models\SecondaryMedicalForm;
use App\Models\User;

class SecondaryMedicalFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-secondary-medical-form');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SecondaryMedicalForm $secondaryMedicalForm): bool
    {
        return $user->hasPermissionTo('view-secondary-medical-form');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-secondary-medical-form');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SecondaryMedicalForm $secondaryMedicalForm): bool
    {
        return $user->hasPermissionTo('update-secondary-medical-form');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SecondaryMedicalForm $secondaryMedicalForm): bool
    {
        return $user->hasPermissionTo('delete-secondary-medical-form');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SecondaryMedicalForm $secondaryMedicalForm): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SecondaryMedicalForm $secondaryMedicalForm): bool
    {
        return $user->hasPermissionTo('delete-secondary-medical-form');
    }
}
