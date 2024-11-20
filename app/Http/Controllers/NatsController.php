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
            'verify' => false,
            'version' => 'dev',
            'tlsCertFile' => "/etc/letsencrypt/live/nd.faveodemo.com/fullchain.pem",
            'tlsKeyFile'  => "/etc/letsencrypt/live/nd.faveodemo.com/privkey.pem",
        ]);

        $configuration->setDelay(0.001);

        $client = new Client($configuration);
        dd($client->ping());
    }
}
