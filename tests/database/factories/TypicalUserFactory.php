<?php

use Faker\Generator;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TypicalUser::class, fn (Generator $faker) => [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    'remember_token' => Str::random(10),
]);
