<?php

namespace App\Providers;

use App\Http\Services\ExternalStorage\Connectors\YaDiskConnector;
use App\Http\Services\ExternalStorage\CredentialsStorage;
use App\Http\Services\ExternalStorage\Router;
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
        $this->app->when(YaDiskConnector::class)
            ->needs('$baseUrl')
            ->giveConfig('storages.driver.ya_disk.base_url');
        $this->app->when(Router::class)
            ->needs('$drivers')
            ->giveConfig('storages.driver');
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
