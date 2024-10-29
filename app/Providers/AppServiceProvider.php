<?php

namespace App\Providers;

use App\Http\Controllers\SocketController;
use App\Services\ConnectionStorageService;
use App\Services\WebsocketService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->singleton(ConnectionStorageService::class, function ($app) {
//            return new ConnectionStorageService();
//        });

        $this->app->singleton(SocketController::class, function () {
            return new SocketController();
        });
//
//        $this->app->singleton(WebsocketService::class, function () {
//            return new WebsocketService();
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
