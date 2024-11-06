<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\EventLoop\Loop;
use React\Socket\SecureServer;
use React\Socket\Server;
use App\Http\Controllers\WebSocketController;
use React\Socket\SocketServer;

class WebSocketSecureServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocketsecure:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $a = app(SocketController::class);
        $this->info('Starting secure WebSocket server...');
        $loop   = Loop::get();
        $webSock = new SecureServer(
            new SocketServer('0.0.0.0:8091'),
            $loop,
            array(
                'local_cert'        => '/etc/apache2/ssl/faveolocal.crt', // path to your cert
                'local_pk'          => '/etc/apache2/ssl/private.key', // path to your server private key
                'allow_self_signed' => TRUE, // Allow self signed certs (should be false in production)
                'verify_peer' => FALSE
            )
        );

        // Ratchet magic
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    $a
                )
            ),
            $webSock
        );

        $loop->addPeriodicTimer(5, function () use ($webServer, $a) {
            $a->sendToAll('hello from server');
            $a->sendToClient('hello from server');
        });

        $loop->run();
    }
}