<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\SocialMediaSetting as SMsetting;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        $this->app->singleton('g_base_settings', function () {
            return Setting::whereIn('key',['header','footer','blog_sidebar_block','social_media_enabled'])->pluck('value','key')->toArray();
        });

        $this->app->singleton('g_social_media_settings', function () {
            return SMsetting::select('name','url','icon')->where('status',1)->orderBy('sort_order')->get()->toArray();
        });

        $this->app->singleton('g_category_menus', function () {
            return Category::select('name','slug')->where('is_show_on_menu',1)->where('status',1)->orderBy('menu_sort')->get()->toArray();
        });      

    } 

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

         view()->composer('*', function($view) {
            $base_settings = app('g_base_settings');          
            $view->with(["g_common_settings"=>$base_settings]);

            $g_social_media_settings = app('g_social_media_settings');
            $view->with(["g_social_media_settings"=>$g_social_media_settings]);

            $g_category_menus = app('g_category_menus');
            $view->with(["g_category_menus"=>$g_category_menus]);
           
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
