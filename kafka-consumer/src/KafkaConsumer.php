<?php

namespace App;

use RdKafka\Conf;
use \RdKafka\KafkaConsumer as RdKafka;

class KafkaConsumer
{
    private RdKafka $consumer;

    public function __construct(Conf $configuration)
    {
        $this->consumer = new RdKafka($configuration);
        $this->consumer->subscribe(['com.kafka.demo']);
    }

    public function startConsuming(): void
    {
        while (true) {
            $message = $this->consumer->consume(100);

            if (RD_KAFKA_RESP_ERR__PARTITION_EOF === $message->err) {
                echo 'Reached end of partition, waiting for more messages...' . PHP_EOL;
                continue;
            } else if (RD_KAFKA_RESP_ERR__TIMED_OUT === $message->err) {
                continue;
            } else if (RD_KAFKA_RESP_ERR_NO_ERROR !== $message->err) {
                echo rd_kafka_err2str($message->err) . PHP_EOL;
                continue;
            }

            echo sprintf(
                    'Read message with key:%s payload:%s topic:%s partition:%d offset:%d',
                    $message->key,
                    $message->payload,
                    $message->topic_name,
                    $message->partition,
                    $message->offset
                ) . PHP_EOL;

            $this->consumer->commit($message);
        }
    }
}