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
            $number = Setting::whatsappNumber();

            $view->with('siteWa', [
                'number'  => $number,                          // 62895635040947
                'display' => Setting::whatsappDisplay(),       // 0895 6350 40947
                'url'     => 'https://wa.me/' . $number,       // link chat langsung
            ]);
        });
    }
}