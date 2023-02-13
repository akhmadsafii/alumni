<?php

namespace App\Providers;

use App\Models\CategorySurvey;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer('content.surveys.v_main', function ($view) {
            $categories = CategorySurvey::where('status', '!=', 0)->get();
            $view->with(['categories' => $categories]);
        });
    }
}
