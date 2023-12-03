<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Policies\PlacePolicy;
use App\Policies\AdsPolicy;
use App\Policies\DishPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Places::class => PlacesPolicy::class,
        //'App\Models\Places' => 'App\Policies\PlacesPolicy',
        // автоматом звязок models:Places <==> PlacesPolicy
        // 'App\Models\Ads' => 'App\Policies\AdsPolicy',
        // 'App\Models\Dish' => 'App\Policies\DishPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-panel', function (User $user) {
            return $user->isAdmin(); // метод в моделі User
        });
    }


}
