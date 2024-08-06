<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

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
        $categories = Category::with(['images'])->withCount('products')->get();
        $pages = Page::all();
        $siteData = Setting::first();
        View::share('categories', $categories);
        View::share('pages', $pages);
        View::share('siteData', $siteData);
    }
}
