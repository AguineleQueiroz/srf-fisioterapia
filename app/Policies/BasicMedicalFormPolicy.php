<?php

namespace App\Policies;

use App\Models\BasicMedicalForm;
use App\Models\User;

class BasicMedicalFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-basic-medical-form');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BasicMedicalForm $patient): bool
    {
        return $user->hasPermissionTo('view-basic-medical-form');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('register-basic-medical-form');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BasicMedicalForm $patient): bool
    {
        return $user->hasPermissionTo('update-basic-medical-form');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BasicMedicalForm $patient): bool
    {
        return $user->hasPermissionTo('delete-basic-medical-form');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BasicMedicalForm $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BasicMedicalForm $patient): bool
    {
        return $user->hasPermissionTo('delete-basic-medical-form');
    }
}
