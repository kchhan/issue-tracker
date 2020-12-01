<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\ProjectPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Project::class => ProjectPolicy::class,
        Ticket::class => TicketPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Allows an admin to perform any function
        Gate::before(function (User $user, $ablility) {
            return $user->hasRole('admin') ? true : null;
        });

    }
}
