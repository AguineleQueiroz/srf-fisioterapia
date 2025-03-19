<?php

namespace App\Providers;

use App\Models\BasicMedicalForm;
use App\Models\PrimaryMedicalForm;
use App\Models\SecondaryMedicalForm;
use App\Models\User;
use App\Policies\BasicMedicalFormPolicy;
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
        BasicMedicalForm::class => BasicMedicalFormPolicy::class,
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
