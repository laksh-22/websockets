<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\EventLoop\Loop;
use React\Socket\SecureServer;
use React\Socket\SocketServer;

class SecureWebsocketServer extends Command
{
    protected $signature = 'websocket:secure';
    protected $description = 'Start the secure WebSocket server';

    public function handle()
    {
        $a = app(SocketController::class);
        $this->info('Starting secure WebSocket server...');
//        $server = IoServer::factory(new HttpServer(new WsServer($a)), 6002);
        // Create an event loop
        $loop =

        // Create a React Socket server
            $loop = Loop::get();
        $socket = new SocketServer('0.0.0.0:6002');
        $secureSocket = new SecureServer($socket, $loop, [
            'local_cert' => '/etc/apache2/ssl/faveolocal.crt',
            'local_pk' => '/etc/apache2/ssl/private.key',
            'allow_self_signed' => true,
            'verify_peer' => false,
        ]);
//        $webSocketServer = IoServer::factory(new HttpServer(new WsServer($a)), 6002);
//        $webSocketServer = new IoServer(
//            new HttpServer(
//                new WsServer(
//                    $a
//                )
//            ),
//            $secureSocket
//        );

        $secureSocket->on('connection', function ($conn) use ($a) {
            // Manually handle the connection as needed
            $a->onOpen($conn);
            $conn->on('message', function ($msg) use ($a, $conn) {
                $a->onMessage($conn, $msg);
            });
            $conn->on('close', function () use ($a, $conn) {
                $a->onClose($conn);
            });
            $conn->on('error', function ($e) use ($a, $conn) {
                $a->onError($conn, $e);
            });
        });
        $loop->run();
//        $secureSocket->on('connection', function ($connection) use ($a, $webSocketServer) {
//            $webSocketServer->run();
////            $connection->on('data', function ($data) use ($a, $webSocketServer) {
////            });
//        });

        // Set up the WebSocket server
//        $secureSocket->listen(6002); // Use the secure socket here

        // Listen for incoming connections
//        $secureSocket->on('connection', function ($conn) use ($webSocketServer) {
//            $webSocketServer->onOpen($conn);
//        });

//        $webSocketServer->run();
    }
}
