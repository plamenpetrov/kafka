<?php

declare(strict_types=1);

use App\KafkaConsumerClient;
use App\KafkaConsumerConfiguration;

require 'src/KafkaConsumerConfiguration.php';
require 'src/KafkaConsumerClient.php';

$conf = new KafkaConsumerConfiguration;

$consumer = new KafkaConsumerClient($conf->getConfiguration());

$consumer->startConsuming();