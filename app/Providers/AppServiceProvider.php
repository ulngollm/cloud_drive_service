<?php

namespace App\Providers;

use App\Http\Services\ExternalStorage\CredentialsStorage;
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
        $this->app->when(CredentialsStorage::class)
            ->needs('$drivers')
            ->giveConfig('storages.driver');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
