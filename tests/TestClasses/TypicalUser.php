<?php

namespace R4nkt\Laravel\Tests\TestClasses;

use Illuminate\Foundation\Auth\User;

class TypicalUser extends User
{
    /** @var string */
    protected $table = 'users';
}