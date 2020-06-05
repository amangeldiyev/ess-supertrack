<?php

namespace App\Providers;

use App\Contracts\SmsProvider;
use App\Services\KcellSms;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(SmsProvider::class, KcellSms::class);
    }
}
