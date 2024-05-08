<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    } // Gate::before(function ($user, $ability) {
        //     return $user->hasRole('super-admin') ? true : null;
        // });

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }


    public function before(Admin $user, string $ability): bool|null
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    
        return null; // see the note above in Gate::before about why null must be returned here.
    }

}
