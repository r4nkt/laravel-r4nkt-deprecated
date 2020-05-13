<?php

namespace R4nkt\Laravel\Tests\Support\CustomPlayerIdResolver;

use Illuminate\Support\Carbon;
use R4nkt\Laravel\Support\DateTimeUtcResolver\DefaultDateTimeUtcResolver;
use R4nkt\Laravel\Tests\TestCase;

class DefaultDateTimeUtcResolverTest extends TestCase
{
    private DefaultDateTimeUtcResolver $resolver;

    public function setUp(): void
    {
        parent::setUp();

        $this->resolver = new DefaultDateTimeUtcResolver();
    }

    /** @test */
    public function it_can_resolve_a_date()
    {
        $dateTime = Carbon::create(2020, 5, 13, 23, 1, 31, 'UTC');

        $resolved = $this->resolver->resolve($dateTime);

        $this->assertIsString($resolved);
        $this->assertEquals('2020-05-13T23:01:31.000000Z', $resolved);
    }

    /** @test */
    public function it_can_resolve_null()
    {
        $this->assertNull($this->resolver->resolve(null));
    }
}
