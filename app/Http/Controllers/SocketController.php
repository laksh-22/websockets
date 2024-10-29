<?php

namespace App\Http\Controllers;

use App\Services\ConnectionStorageService;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use React\EventLoop\Loop;
use React\Socket\TcpServer;

class SocketController extends Controller implements MessageComponentInterface
{
    protected $clients;
    protected $storageService;

    protected $a;
    public function __construct()
    {
//        $this->storageService = $storageService;
        $this->clients = new \SplObjectStorage;
//        $this->initializeMessageListener();
//        $this->a = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
//        dump($conn->resourceId);
//        $this->clients->attach($conn);
        $this->clients->attach($conn, ['user_id' => $conn->resourceId]);

//        $this->clients[$conn->resourceId] = $conn;
//        dd($conn);
//        dd($this->clients[0]);
//        foreach ($this->clients as $client) {
//            dd($this->clients->offsetGet($client));
////            dd($clientData = $this->clients[$client]);
//        }
//        $this->storageService->addClient($conn);

//        dd($conn->resourceId);


        echo "connection open\n";
//        dd(self::$clients);

        foreach ($this->clients as $client) {

            $client->send(json_encode(['server calling']));
        };

    }

    public function onMessage(ConnectionInterface $from, $msg)
    {

//        echo "message received";
//        echo $msg;
        echo "message is:" . $msg ."\n";
//        $this->storageService->broadcast(json_encode(['message' => $msg]));
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "connection closed\n";
        $this->detach($conn);
//        $this->storageService->removeClient($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} \n";

        $conn->close();
    }

    public function sendMessageToClient($message): void
    {
//        dd(app(ConnectionInterface::class));
//        dd(self::$clients);
//        foreach ($this->clients as $client) {
//            $client->send(json_encode(['message' => $message]));
//        }

//        dump('oooo');
    }

    public function sendToAll($message) {
        foreach ($this->clients as $client) {
            $client->send(json_encode($message));
        }
    }

    protected function initializeMessageListener()
    {
        echo "hiiii\n";
        $loop = Loop::get();
        $socket = new TcpServer('127.0.0.1:6003', $loop);

        $socket->on('connection', function ($connection) {
            echo "hiiii\n";
            $connection->on('data', function ($data) {
                // Send the received data to all WebSocket clients
                $this->sendToAll(trim($data));
            });
        });
    }
//
    public function sendToClient($message)
    {
        foreach ($this->clients as $client) {
            $clientData = $this->clients->offsetGet($client);
//            $userInfo = $client->getUserInfo();
            if($clientData['user_id'] == 180) {
                $client->send(json_encode($message));
            }
        }
    }
}
