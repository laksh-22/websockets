<?php

namespace App\Services;

use App\Http\Controllers\SocketController;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebsocketService
{
    protected $server;

    public function startWebSocketServer(SocketController $socketController)
    {
        $this->server = IoServer::factory(new HttpServer(new WsServer($socketController)), 6002);
        $this->server->run();
    }
}
