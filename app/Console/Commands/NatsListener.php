<?php

namespace App\Console\Commands;

use Basis\Nats\Client;
use Basis\Nats\Configuration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NatsListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nats:listener';

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
        $this->info(1);
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

        $configuration->setDelay(0.001);
        $client = new Client($configuration);

        $queue = $client->subscribe('test.event');

        if(!empty($queue->fetch())) {
            Log::channel('nats')->info($queue->fetch());
            if(!empty($queue->fetch()->payload)) {
                Log::channel('nats')->info($queue->fetch()->payload);
                if(!empty($queue->fetch()->payload->body)) {
                    $this->info($queue->fetch()->payload->body);
                    Log::channel('nats')->info($queue->fetch()->payload->body);
                }
            }
        }
//        $this->info($queue->fetch()->payload->body);
    }
}
