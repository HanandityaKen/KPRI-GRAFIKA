<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\NamaKoperasi;
use App\Models\LogoKoperasi;

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
        Carbon::setLocale('id');

        View::composer('*', function ($view) {
            $view->with([
                'namaKoperasi' => NamaKoperasi::first(),
                'logoKoperasi' => LogoKoperasi::first(),
            ]);
        });
    }
}
