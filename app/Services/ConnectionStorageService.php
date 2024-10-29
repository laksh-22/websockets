<?php

namespace App\Services;

use Ratchet\ConnectionInterface;
use SplObjectStorage;

class ConnectionStorageService
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage;
    }

    public function addClient(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function removeClient(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function broadcast($message)
    {
//        dump($this->clients);
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }

    public function getClients()
    {
        return $this->clients;
    }
}
