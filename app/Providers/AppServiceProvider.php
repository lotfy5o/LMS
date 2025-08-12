<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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

        if (Schema::hasTable('smtp_settings')) {
            $smtpsetting = SmtpSetting::first();

            if ($smtpsetting) {
                $data = [
                    'driver' => $smtpsetting->mailer,
                    'host' => $smtpsetting->host,
                    'port' => $smtpsetting->port,
                    'username' => $smtpsetting->username,
                    'password' => $smtpsetting->password,
                    'encryption' => $smtpsetting->encryption,
                    'from' => [
                        'address' => $smtpsetting->from_address,
                        'name' => 'LMS'
                    ]

                ];
                Config::set('mail', $data);
            }
        } // end if
    }
}
