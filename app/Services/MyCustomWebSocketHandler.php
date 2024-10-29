<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class MyCustomWebSocketHandler implements MessageComponentInterface
{
//    protected static $clients;

//    public function __construct()
//    {
////        dd('ijhgfd');
//        self::$clients = new \SplObjectStorage;
//    }

    public function onOpen(ConnectionInterface $conn)
    {
        $conn->send("Connection established with custom WebSocket handler!");
//        dump('poiuytr');
        Log::info('connection open');
//        dd('ytds');
        echo "opening connection\n";
//        self::$clients->attach($conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "connection closed\n";
//        self::$clients->detach($connection);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
//        self::$clients->detach($connection);
        $conn->close();
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
//        echo "message is:" . $msg ."\n";
    }
}
