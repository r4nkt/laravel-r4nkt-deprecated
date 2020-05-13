<?php

namespace R4nkt\Laravel\Tests\Support\CustomPlayerIdResolver;

use R4nkt\Laravel\Support\CustomPlayerIdResolver\HashidsCustomPlayerIdResolver;
use R4nkt\Laravel\Tests\TestCase;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;
use R4nkt\Laravel\Tests\TestClasses\UuidUser;
use Vinkla\Hashids\Facades\Hashids;

class HashidsCustomPlayerIdResolverTest extends TestCase
{
    private HashidsCustomPlayerIdResolver $resolver;

    public function setUp(): void
    {
        parent::setUp();

        $this->resolver = new HashidsCustomPlayerIdResolver();
    }

    /** @test */
    public function it_can_resolve_a_typical_model()
    {
        $user = factory(TypicalUser::class)->create();

        $resolved = $this->resolver->resolve($user);

        $this->assertIsString($resolved);
        $this->assertSame(Hashids::encode($user->id), $resolved);
        $this->assertSame($user->id, Hashids::decode($resolved)[0]);
    }

    /** @test */
    public function it_cannot_resolve_a_model_with_a_uuid_as_Hashids_key()
    {
        $user = factory(UuidUser::class)->create();

        $resolved = $this->resolver->resolve($user);

        $this->assertNotEquals($user->uuid, $resolved);
        $this->assertEmpty($resolved);
    }
}
