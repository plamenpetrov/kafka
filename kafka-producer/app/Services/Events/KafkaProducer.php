<?php

namespace App\Services\Events;

use App\Contracts\Producer;
use RdKafka\Producer as RdKafkaProducer;

class KafkaProducer implements Producer
{
    private RdKafkaProducer $producer;
    private string $topic;
    private int $maxFlushRetries;
    private int $timeout;

    public function __construct(
        RdKafkaProducer $producer,
        string $topic,
        int $maxFlushRetries,
        int $timeout
    ) {
        $this->producer = $producer;
        $this->topic = $topic;
        $this->maxFlushRetries = $maxFlushRetries;
        $this->timeout = $timeout;
    }

    public function produce(string $message): void
    {
        $this->producer->newTopic($this->topic)->producev(
            RD_KAFKA_PARTITION_UA,
            0,
            $message,
            null,
            [
                'X-DEMO-H' => 'KAFKA DEMO'
            ]
        );

    }

    public function __destruct()
    {
        for ($flushRetries = 0; $flushRetries < $this->maxFlushRetries; $flushRetries++) {
            $result = $this->producer->flush($this->timeout);
            if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
                return;
            }
        }
    }

}