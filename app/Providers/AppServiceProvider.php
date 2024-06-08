<?php

namespace App\Providers;

use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\UserAndLead\Models\Lead;
use Modules\UserAndLead\Polices\LeadPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('api-response', ApiResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Lead::class, LeadPolicy::class);
    }
}
