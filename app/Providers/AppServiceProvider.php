<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive( 'breadcrumbs', function ($expression) {
            return "<?php echo Breadcrumbs::render($expression); ?>";
        } );
    }
}
