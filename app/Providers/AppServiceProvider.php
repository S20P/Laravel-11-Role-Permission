<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        $this->app->singleton('base_settings', function () {
            return Setting::whereIn('key',['header','footer'])->pluck('value','key')->toArray();
        });

    } 

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('*', function($view) {
            $base_settings = app('base_settings');
            $view->with(["common_settings"=>$base_settings]);
        });
        
    }


    public function before(Admin $user, string $ability): bool|null
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    
        return null; // see the note above in Gate::before about why null must be returned here.
    }

}
