<?php

namespace App\Providers;

use App\Models\Investment;
use App\Models\Loan;
use App\Models\Package;
use App\Models\Withdraw;
use App\Policies\InvestmentPolicy;
use App\Policies\LoanPolicy;
use App\Policies\PackagePolicy;
use App\Policies\RolePolicy;
use App\Policies\WithdrawalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Investment::class => InvestmentPolicy::class,
        Package::class => PackagePolicy::class,
        Loan::class => LoanPolicy::class,
        Withdraw::class => WithdrawalPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Checks if users is and admin
        Gate::define('isAdmin', function ($user) {
            return $user->admin == true;
        });
    }
}
