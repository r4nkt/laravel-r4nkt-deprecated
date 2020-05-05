<?php

namespace R4nkt\Laravel\Support;

class WebhookCall
{
    public $payload = [];

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function type(): string
    {
        return $this->payload['type'];
    }

    public function dateTime(): string
    {
        return $this->payload['dateTime'];
    }
}
