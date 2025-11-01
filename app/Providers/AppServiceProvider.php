<?php

namespace App\Providers;

use App\Models\News;
use Illuminate\Support\Facades\View;
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
        // Share latest headlines with all views
        View::composer('*', function ($view) {
            $latestHeadlines = News::published()
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->select('title', 'slug', 'category_id')
                ->get();
            
            $view->with('latestHeadlines', $latestHeadlines);
        });
    }
}
