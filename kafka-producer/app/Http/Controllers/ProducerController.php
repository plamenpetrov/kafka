<?php

namespace App\Http\Controllers;

use App\Contracts\Producer;

class ProducerController extends Controller
{

    public function produceEvent(Producer $producer)
    {
        $producer->produce(\GuzzleHttp\json_encode([
            'name' => 'Kafka producer',
            'email' => 'kafka@producer.com'
        ]));

        return true;
    }
}