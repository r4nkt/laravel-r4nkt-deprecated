<?php

namespace R4nkt\Laravel\Tests;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use R4nkt\Laravel\Support\WebhookCall;
use R4nkt\Laravel\Tests\Jobs\DummyJob;

class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Event::fake();

        Bus::fake();

        Route::r4nktWebhooks('r4nkt-webhooks');

        config(['r4nkt.jobs' => ['badge-earned' => DummyJob::class]]);
    }

    /** @test */
    public function it_can_handle_a_valid_request()
    {
        $this->withoutExceptionHandling();

        $payload = $this->getTestPayload();

        $headers = ['R4nkt-Signature' => $this->determineR4nktSignature($payload)];

        $this
            ->postJson('r4nkt-webhooks', $payload, $headers)
            ->assertSuccessful();

        Event::assertDispatched('r4nkt-webhooks::badge-earned', function ($event, $eventPayload) {
            if (! $eventPayload instanceof WebhookCall) {
                return false;
            }

            if ($eventPayload->type() != 'badge-earned') {
                return false;
            }

            if ($eventPayload->dateTime() != '2020-05-02T21:47:59.624812Z') {
                return false;
            }

            return true;
        });

        Bus::assertDispatched(DummyJob::class, function (DummyJob $job) {
            return $job->webhookCall->type() === 'badge-earned';
        });
    }

    /** @test */
    public function no_jobs_or_events_will_be_fired_if_a_request_has_an_invalid_signature()
    {
        $payload = $this->getTestPayload();

        $headers = ['R4nkt-Signature' => 'invalid_signature'];

        $this
            ->postJson('r4nkt-webhooks', $payload, $headers)
            ->assertStatus(400);

        Event::assertNotDispatched('r4nkt-webhooks::badge-earned');

        Bus::assertNotDispatched(DummyJob::class);
    }

    /**
     * @return array
     */
    public function getTestPayload(): array
    {
        return [
            'type' => 'badge-earned',
            'dateTime' => '2020-05-02T21:47:59.624812Z',
        ];
    }
}
