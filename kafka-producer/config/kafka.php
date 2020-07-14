<?php

return [
    'metadata' => [
        'broker' => [
            'list' => env('KAFKA_METADATA_BROKER_LIST'),
        ]
    ],
    'topic' => env('KAFKA_TOPIC'),
    'max_flush_retries' => env('KAFKA_MAX_FLUSH_RETRIES', 10),
    'timeout' => env('KAFKA_TIMEOUT_IN_MS', 10000)
];
