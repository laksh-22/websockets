<?php

namespace App\Http\Controllers;

use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
use BeyondCode\LaravelWebSockets\Facades\StatisticsLogger;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\ChannelManager;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\WebSocketException;
use BeyondCode\LaravelWebSockets\WebSockets\Messages\PusherMessageFactory;
use BeyondCode\LaravelWebSockets\WebSockets\WebSocketHandler;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class WebSocketController extends WebSocketHandler
{
//    public function __construct(ChannelManager $channelManager)
//    {
//        $this->channelManager = $channelManager;
//        parent::__construct($channelManager);
//    }
//
//    public function onOpen(ConnectionInterface $connection)
//    {
//        echo "New connection to /receive-websocket\n";
//        //        $this
////            ->verifyAppKey($connection)
////            ->limitConcurrentConnections($connection)
////            ->generateSocketId($connection)
////            ->establishConnection($connection);
//    }
//
//    public function onMessage(ConnectionInterface $connection, MessageInterface $msg)
//    {
//        echo "Message received: {$msg}\n";
//        foreach ($this->clients as $client) {
//            if ($from !== $client) {
//                $client->send("Broadcast message: {$msg}");
//            }
//        }
////        $message = PusherMessageFactory::createForMessage($msg, $connection, $this->channelManager);
////
////        $message->respond();
////
////        StatisticsLogger::webSocketMessage($connection);
//    }
//
//    public function onClose(ConnectionInterface $connection)
//    {
//        $this->channelManager->removeFromAllChannels($connection);
//
//        DashboardLogger::disconnection($connection);
//
//        StatisticsLogger::disconnection($connection);
//    }
//
//    public function onError(ConnectionInterface $connection, \Exception $exception)
//    {
//        if ($exception instanceof WebSocketException) {
//            $connection->send(json_encode(
//                $exception->getPayload()
//            ));
//        }
//    }
//
//    protected function verifyAppKey(ConnectionInterface $connection)
//    {
//        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');
//
//        if (! $app = App::findByKey($appKey)) {
//            throw new UnknownAppKey($appKey);
//        }
//
//        $connection->app = $app;
//
//        return $this;
//    }
}
