<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Panier;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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

        $userId = Auth::id();

        // Only load cart if user is logged in
        $cart = $userId
            ? Panier::where('user_id', $userId)->get()
            : collect();

        $view->with('cart', $cart);
    });

        View::share('categories', Category::all());
        
        
        Gate::define('access-admin', function (User $user) {
            return $user->is_admin == 1; // true if role = admin or super_admin
        });
    }
}
