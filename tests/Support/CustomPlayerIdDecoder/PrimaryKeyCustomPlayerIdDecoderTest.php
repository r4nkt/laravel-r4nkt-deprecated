<?php

namespace R4nkt\Laravel\Tests\Support\CustomPlayerIdDecoder;

use R4nkt\Laravel\Support\CustomPlayerIdDecoder\PrimaryKeyCustomPlayerIdDecoder;
use R4nkt\Laravel\Tests\TestCase;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;
use R4nkt\Laravel\Tests\TestClasses\UuidUser;

class PrimaryKeyCustomPlayerIdDecoderTest extends TestCase
{
    private PrimaryKeyCustomPlayerIdDecoder $decoder;

    public function setUp(): void
    {
        parent::setUp();

        $this->decoder = new PrimaryKeyCustomPlayerIdDecoder();
    }

    /** @test */
    public function it_can_decode_a_typical_model()
    {
        $user = factory(TypicalUser::class)->create();

        $decoded = $this->decoder->decode((string)$user->id);

        $this->assertIsString($decoded);
        $this->assertEquals($user->id, $decoded);
    }

    /** @test */
    public function it_can_decode_a_model_with_a_uuid_as_primary_key()
    {
        $user = factory(UuidUser::class)->create();

        $decoded = $this->decoder->decode($user->uuid);

        $this->assertIsString($decoded);
        $this->assertEquals($user->uuid, $decoded);
    }
}
