<?php

declare(strict_types = 1);

namespace App;

use RdKafka\Conf;

class KafkaConsumerConfiguration
{
    public function getConfiguration(): Conf
    {
        $conf = new Conf();
        $conf->set('client.id', 'php-kafka-consumer');
        $conf->set('group.id', 'php-kafka-consumer');
        $conf->set('metadata.broker.list', 'kafka-broker:9092');
        $conf->set('enable.auto.commit', 'false');
        $conf->set('auto.offset.reset', 'earliest');
        $conf->set('enable.partition.eof', 'true');
        return $conf;
    }
}