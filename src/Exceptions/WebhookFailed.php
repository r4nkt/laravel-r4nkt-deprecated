<?php

namespace R4nkt\Laravel\Exceptions;

use Exception;
use Illuminate\Http\Request;
use R4nkt\Laravel\Support\WebhookCall;

class WebhookFailed extends Exception
{
    public static function missingSignature()
    {
        return new static('The request did not contain a header named `R4nkt-Signature`.');
    }

    public static function invalidSignature($signature)
    {
        return new static("The signature `{$signature}` found in the header named `R4nkt-Signature` is invalid. Make sure that the `r4nkt.signing_secret` config key is set to the value you found on the R4nkt dashboard. If you are caching your config try running `php artisan clear:cache` to resolve the problem.");
    }

    public static function signingSecretNotSet()
    {
        return new static('The R4nkt webhook signing secret is not set. Make sure that the `r4nkt.signing_secret` config key is set to the value you found on the R4nkt dashboard.');
    }

    public static function missingType(Request $request)
    {
        return new static('The webhook call did not contain a type. Valid R4nkt webhook calls should always contain a type.');
    }

    public static function jobClassDoesNotExist($jobClass, WebhookCall $webhookCall)
    {
        return new static("The job class, `{$jobClass}`, to handle the webhook call for `{$webhookCall->type()}` could not be found.");
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], 400);
    }
}
