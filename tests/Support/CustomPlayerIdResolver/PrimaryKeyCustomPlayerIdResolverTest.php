<?php

namespace R4nkt\Laravel\Tests\Support\CustomPlayerIdResolver;

use R4nkt\Laravel\Support\CustomPlayerIdResolver\PrimaryKeyCustomPlayerIdResolver;
use R4nkt\Laravel\Tests\TestCase;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;
use R4nkt\Laravel\Tests\TestClasses\UuidUser;

class PrimaryKeyCustomPlayerIdResolverTest extends TestCase
{
    private PrimaryKeyCustomPlayerIdResolver $resolver;

    public function setUp(): void
    {
        parent::setUp();

        $this->resolver = new PrimaryKeyCustomPlayerIdResolver();
    }

    /** @test */
    public function it_can_resolve_a_typical_model()
    {
        $user = factory(TypicalUser::class)->create();

        $resolved = $this->resolver->resolve($user);

        $this->assertIsString($resolved);
        $this->assertEquals($user->id, $resolved);
    }

    /** @test */
    public function it_can_resolve_a_model_with_a_uuid_as_primary_key()
    {
        $user = factory(UuidUser::class)->create();

        $resolved = $this->resolver->resolve($user);

        $this->assertIsString($resolved);
        $this->assertEquals($user->uuid, $resolved);
    }
}
