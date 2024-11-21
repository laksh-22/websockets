<?php

namespace App\Http\Controllers;

use Basis\Nats\Client;
use Basis\Nats\Configuration;
use Illuminate\Http\Request;

class NatsController extends Controller
{
    public function setupNats()
    {
        $configuration = new Configuration([
            'host' => '159.69.195.251',
            'jwt' => null,
            'lang' => 'php',
            'pass' => null,
            'pedantic' => false,
            'port' => 4222,
            'reconnect' => true,
            'timeout' => 1,
            'token' => null,
            'user' => null,
            'nkey' => null,
            'verbose' => false,
            'version' => 'dev',
        ]);
//        $configuration = new Configuration([
//            'host' => 'localhost',
//            'jwt' => null,
//            'lang' => 'php',
//            'pass' => null,
//            'pedantic' => false,
//            'port' => 4222,
//            'reconnect' => true,
//            'timeout' => 1,
//            'token' => null,
//            'user' => null,
//            'nkey' => null,
//            'verbose' => false,
////            'verify' => false,
//            'version' => 'dev',
//            'tlsCertFile' => "/etc/letsencrypt/live/nd.faveodemo.com/fullchain.pem",
//            'tlsKeyFile'  => "/etc/letsencrypt/live/nd.faveodemo.com/privkey.pem",
//        ]);

        $configuration->setDelay(0.001);
//dd($configuration);
        $client = new Client($configuration);
        dump($client->ping());

//        $queue = $client->subscribe('test.event');

        $client->publish('test.event', 'lakshyaa');

//        dump($queue->fetch()->payload->body);

//        $client->publish('test.event', 'world');

//        dump($queue->fetch()->payload->body);


    }
}
