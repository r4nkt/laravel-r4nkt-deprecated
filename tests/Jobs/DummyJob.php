<?php

namespace R4nkt\Laravel\Tests\Jobs;

use R4nkt\Laravel\Support\WebhookCall;

class DummyJob
{
    /** @var \R4nkt\Laravel\Support\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
    }
}
