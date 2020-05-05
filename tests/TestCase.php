<?php

namespace R4nkt\Laravel\Tests;

use R4nkt\Laravel\R4nktServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        config(['r4nkt.signing_secret' => 'test_signing_secret']);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            R4nktServiceProvider::class,
        ];
    }

    protected function determineR4nktSignature(array $payload): string
    {
        $secret = config('r4nkt.signing_secret');

        return hash_hmac('sha256', json_encode($payload), $secret);
    }
}
