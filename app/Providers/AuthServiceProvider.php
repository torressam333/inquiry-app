<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

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

        Gate::define('update-question', function ($user, $question) {
            return $user->id === $question->user_id
                ? Response::allow()
                : Response::deny('You must be the user who owns this question to edit');
        });

        Gate::define('delete-question', function ($user, $question) {
            return $user->id === $question->user_id;
        });

    }
}
