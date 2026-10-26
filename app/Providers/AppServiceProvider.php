<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $setting = Setting::first();
            $number  = Setting::whatsappNumber();

            $view->with('siteWa', [
                'number'  => $number,
                'display' => Setting::whatsappDisplay(),
                'url'     => Setting::whatsappUrl(),
            ]);
            $view->with('siteSetting', $setting);
        });
    }
}