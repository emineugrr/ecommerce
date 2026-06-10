<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        // Automatically shares categories with your layout and product views
        View::composer(['frontend.layout.layout', 'frontend.pages.products'], function ($view) {
            $categories = Category::all(); // Fetches all categories
            $view->with('categories', $categories);
        });
    }
}
