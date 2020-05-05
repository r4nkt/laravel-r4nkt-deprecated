<?php

namespace R4nkt\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use R4nkt\Laravel\Exceptions\WebhookFailed;
use R4nkt\Laravel\Http\Middleware\VerifySignature;
use R4nkt\Laravel\Support\WebhookCall;

class WebhookController extends Controller
{
    public function __construct()
    {
        $this->middleware(VerifySignature::class);
    }

    public function __invoke(Request $request)
    {
        $eventPayload = json_decode($request->getContent(), true);

        if (! isset($eventPayload['type'])) {
            throw WebhookFailed::missingType($request);
        }

        $type = $eventPayload['type'];

        $webhookCall = new WebhookCall($eventPayload);

        event("r4nkt-webhooks::{$type}", $webhookCall);

        $jobClass = $this->determineJobClass($type);

        if ($jobClass === '') {
            return;
        }

        if (! class_exists($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobClass, $webhookCall);
        }

        dispatch(new $jobClass($webhookCall));
    }

    protected function determineJobClass(string $type): string
    {
        return config("r4nkt.jobs.{$type}", '');
    }
}
