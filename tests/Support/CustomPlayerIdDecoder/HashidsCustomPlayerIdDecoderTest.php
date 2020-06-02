<?php

namespace R4nkt\Laravel\Tests\Support\CustomPlayerIdDecoder;

use R4nkt\Laravel\Support\CustomPlayerIdDecoder\HashidsCustomPlayerIdDecoder;
use R4nkt\Laravel\Tests\TestCase;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;
use Vinkla\Hashids\Facades\Hashids;

class HashidsCustomPlayerIdDecoderTest extends TestCase
{
    private HashidsCustomPlayerIdDecoder $decoder;

    public function setUp(): void
    {
        parent::setUp();

        $this->decoder = new HashidsCustomPlayerIdDecoder();
    }

    /** @test */
    public function it_can_decode_a_typical_model()
    {
        $user = factory(TypicalUser::class)->create();

        $encoded = Hashids::encode($user->id);

        $decoded = $this->decoder->decode($encoded);

        $this->assertNotEquals($decoded, $encoded);
        $this->assertIsString($decoded);
        $this->assertEquals($user->id, $decoded);
    }
}
