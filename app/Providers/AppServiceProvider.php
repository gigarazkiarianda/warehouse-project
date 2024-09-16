<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Biodata;
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
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $biodata = Biodata::where('user_id', auth()->user()->id)->first();
                $view->with('biodata', $biodata);
            }
        });
    }
}
