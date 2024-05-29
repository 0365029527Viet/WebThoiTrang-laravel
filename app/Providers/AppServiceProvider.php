<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        view()->composer('template.client', function ($view) {
            $data = Category::all();
            $banner = Banner::where('status', 1)->limit(2)->get();
            $view->with(['data'=> $data, 'banner'=> $banner]);
        });
    }
}
