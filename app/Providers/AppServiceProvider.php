<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom Blade directives for permission checking
        \Illuminate\Support\Facades\Blade::directive('hasPermission', function ($expression) {
            return "<?php if(hasPermission($expression)): ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('endhasPermission', function () {
            return "<?php endif; ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('canAccess', function ($expression) {
            return "<?php if(canAccess($expression)): ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('endcanAccess', function () {
            return "<?php endif; ?>";
        });
    }
}
