<?php

namespace App\Contracts;

interface Producer
{
    public function produce(string $message): void;
}