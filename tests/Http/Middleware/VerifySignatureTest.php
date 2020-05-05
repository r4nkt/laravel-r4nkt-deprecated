<?php

namespace R4nkt\Laravel\Tests\Http\Middleware;

use Illuminate\Support\Facades\Route;
use R4nkt\Laravel\Http\Middleware\VerifySignature;
use R4nkt\Laravel\Tests\TestCase;

class VerifySignatureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::post('r4nkt-webhooks', function () {
            return 'ok';
        })->middleware(VerifySignature::class);
    }

    /** @test */
    public function it_will_succeed_when_the_request_has_a_valid_signature()
    {
        $payload = [
            'event' => 'uptimeCheckFailed',
        ];

        $response = $this->postJson(
            'r4nkt-webhooks',
            $payload,
            ['R4nkt-Signature' => $this->determineR4nktSignature($payload)]
        );

        $response
            ->assertStatus(200)
            ->assertSee('ok');
    }

    /** @test */
    public function it_will_fail_when_the_signature_header_is_not_set()
    {
        $payload = [
            'event' => 'uptimeCheckFailed',
        ];

        $response = $this->postJson(
            'r4nkt-webhooks',
            $payload
        );

        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => 'The request did not contain a header named `R4nkt-Signature`.',
            ]);
    }

    /** @test */
    public function it_will_fail_when_the_signing_secret_is_not_set()
    {
        config(['r4nkt.signing_secret' => '']);

        $response = $this->postJson(
            'r4nkt-webhooks',
            ['type' => 'badge-earned'],
            ['R4nkt-Signature' => 'abc']
        );

        $response
            ->assertStatus(400)
            ->assertSee('The R4nkt webhook signing secret is not set');
    }

    /** @test */
    public function it_will_fail_when_the_signature_is_invalid()
    {
        $response = $this->postJson(
            'r4nkt-webhooks',
            ['type' => 'badge-earned'],
            ['R4nkt-Signature' => 'abc']
        );

        $response
            ->assertStatus(400)
            ->assertSee('found in the header named `R4nkt-Signature` is invalid');
    }
}
