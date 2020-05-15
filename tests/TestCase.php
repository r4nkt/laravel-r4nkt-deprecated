<?php

namespace R4nkt\Laravel\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use R4nkt\Laravel\R4nktServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/database/factories');

        $this->migrateDb();
    }

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

    protected function migrateDb(): self
    {
        $migrationsPath = realpath(__DIR__ . '/database/migrations');
        $migrationsPath = str_replace('\\', '/', $migrationsPath);

        $this->artisan("migrate --path={$migrationsPath} --realpath")
            ->assertExitCode(0);

        return $this;
    }
}
