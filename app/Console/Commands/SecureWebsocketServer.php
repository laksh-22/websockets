<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\EventLoop\Loop;
use React\Socket\SecureServer;
use React\Socket\SocketServer;
use React\Socket\TcpServer;

class SecureWebsocketServer extends Command implements MessageComponentInterface
{
    protected $signature = 'websocket:secure';
    protected $description = 'Start the secure WebSocket server';

//    public function handle()
//    {
//        $a = app(SocketController::class);
//        $this->info('Starting secure WebSocket server...');
//
//        // Create a React Socket server
//        $loop = Loop::get();
////        gethostbyname(gethostname());
//
////        $socket = new TcpServer('0.0.0.0:6002');
//        $socket = new TcpServer(gethostbyname(gethostname()).':6002');
//        $secureSocket = new SecureServer($socket, $loop, [
//            'local_cert' => '/etc/apache2/ssl/faveolocal.crt',
//            'local_pk' => '/etc/apache2/ssl/private.key',
//            'allow_self_signed' => true,
//            'verify_peer' => false,
//        ]);
//
//        $secureSocket->on('connection', function ($conn) use ($a) {
//            echo 'Plaintext connection from ' . $conn->getRemoteAddress() . PHP_EOL;
//            $conn->write('hello there!' . PHP_EOL);
//            $conn->on('data', function ($data) use ($conn) {
//                echo $data;
//            });
//            // Manually handle the connection as needed
////            $a->onOpen($conn);
////            $conn->on('message', function ($msg) use ($a, $conn) {
////                $a->onMessage($conn, $msg);
////            });
////            $conn->on('close', function () use ($a, $conn) {
////                $a->onClose($conn);
////            });
////            $conn->on('error', function ($e) use ($a, $conn) {
////                $a->onError($conn, $e);
////            });
//        });
//
//        $secureSocket->on('error', function (\Exception $e) {
//           $this->error($e->getMessage());
//        });
//        $loop->run();
//    }

    public function handle()
    {
        $a = app(SocketController::class);
        $this->info('Starting secure WebSocket server...');

        $loop = Loop::get();

        $socket = new SocketServer('tls://159.69.195.251:6002', [
            'tls' => [
                'local_cert' => '/etc/letsencrypt/live/nd.faveodemo.com/fullchain.pem',
                'local_pk' => '/etc/letsencrypt/live/nd.faveodemo.com/privkey.pem',
                'allow_self_signed' => false,
                'verify_peer' => false,
            ]
        ]);

//        $secureSocket = new SecureServer($socket, $loop, [
//            'local_cert' => '/etc/apache2/ssl/faveolocal.crt',
//            'local_pk' => '/etc/apache2/ssl/private.key',
//            'allow_self_signed' => true,
//            'verify_peer' => false,
//        ]);

        $server = new IoServer($this, $socket, $loop);
//        $socket = IoServer::factory(new HttpServer(new WsServer($a)), 6002);


//        $socket->on('connection', function ($conn) use ($a) {
//            echo 'Plaintext connection from ' . $conn->getRemoteAddress() . PHP_EOL;
//            $conn->write('hello there!');
//            $conn->on('data', function ($data) use ($conn) {
//                echo $data;
//            });
//        });
////
//        $socket->on('error', function (\Exception $e) {
//            $this->error($e->getMessage());
//        });
        $loop->run();
    }

    public function onOpen(\Ratchet\ConnectionInterface $conn)
    {
        echo "New connection: {$conn->remoteAddress}\n";
        $conn->send("Hello from PHP WebSocket server!");
    }

    public function onMessage(\Ratchet\ConnectionInterface $from, $msg)
    {
        echo "Message received: $msg\n";
//        $conn->send("Message echoed: $msg");
    }

    public function onClose(\Ratchet\ConnectionInterface $conn)
    {
        echo "Connection closed\n";
    }

    public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}
