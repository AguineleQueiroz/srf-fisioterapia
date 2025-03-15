<?php

namespace App\Providers;

use App\Models\Patient;
use App\Models\PrimaryMedicalForm;
use App\Models\SecondaryMedicalForm;
use App\Models\User;
use App\Policies\PatientPolicy;
use App\Policies\PrimaryMedicalFormPolicy;
use App\Policies\SecondaryMedicalFormPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Patient::class => PatientPolicy::class,
        PrimaryMedicalForm::class => PrimaryMedicalFormPolicy::class,
        SecondaryMedicalForm::class => SecondaryMedicalFormPolicy::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
