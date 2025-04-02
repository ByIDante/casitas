<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\PropertyRating;
use App\Models\User;
use App\Policies\PropertyPolicy;
use App\Policies\PropertyRatingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        PropertyRating::class => PropertyRatingPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Puedes definir Gates aquí si es necesario
        Gate::define('admin', fn($user): mixed => $user->isAdmin());
    }
}
