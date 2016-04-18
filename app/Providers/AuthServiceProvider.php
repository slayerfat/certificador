<?php

namespace App\Providers;

use App\PersonalDetail;
use App\Policies\PersonalDetailPolicy;
use App\Policies\ProfessorPolicy;
use App\Policies\UserPolicy;
use App\Professor;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class           => UserPolicy::class,
        PersonalDetail::class => PersonalDetailPolicy::class,
        Professor::class      => ProfessorPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}
