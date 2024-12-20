<?php

namespace App\Console;

use App\Console\Commands\NatsListener;
use App\Console\Commands\SecureWebsocketServer;
use App\Console\Commands\WebSocketSecureServer;
use App\Console\Commands\WebSocketServer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SecureWebsocketServer::class,
        WebSocketServer::class,
        WebSocketSecureServer::class,
        NatsListener::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
//        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
