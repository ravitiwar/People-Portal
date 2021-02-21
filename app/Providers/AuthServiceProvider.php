<?php

namespace App\Providers;

use App\Utils\AppUtils;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $user = Auth::user();
        foreach (AppUtils::getMapingForendpoints() as $mapingForendpoint) {
            Gate::define("{$mapingForendpoint['capability']}", function ($user) use ( $mapingForendpoint) {
                return in_array($mapingForendpoint['capability'], $user->role->capabilities);
            });
        }

        Passport::routes();


    }
}
