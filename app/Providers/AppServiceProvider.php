<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }

        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $cartCount = 0;
            if (Auth::check() && Auth::user()->isAdmin == 0) {
                $cartCount = Keranjang::where('user_id', Auth::id())->count();
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
