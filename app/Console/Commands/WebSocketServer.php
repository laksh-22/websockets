<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use App\Services\WebsocketService;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $a = app(SocketController::class);
        $this->info('starting websocket server');
        $server = IoServer::factory(new HttpServer(new WsServer($a)), 6002);


        $server->loop->addPeriodicTimer(5, function () use ($server, $a) {
//            foreach ($server->clients as $client) {
//                $client->send(json_encode(['timerrr']));
//            }
//            dd($a->clients);
//            dd($server);
//            $a->sendToAll('hello from server');
            $a->sendToClient('hello from server');
//            echo "timer";
        });

        $server->run();
    }
}
