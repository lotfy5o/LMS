<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
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
        view()->composer('frontend.master', function ($view) {
            $headerCategories = Category::with('subCategories', 'courses')->orderBy('name', 'ASC')->get();
            $view->with('headerCategories', $headerCategories);
        });

        View::composer('*', function ($view) {
            $cart = Cart::with('courses')
                ->where('session_id', session()->getId())
                ->first();
            $view->with('cart', $cart);
        });
    }
}
