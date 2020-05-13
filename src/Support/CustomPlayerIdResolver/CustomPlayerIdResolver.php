<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdResolver;

use Illuminate\Database\Eloquent\Model;

abstract class CustomPlayerIdResolver
{
    abstract public function resolve(Model $player): string;
}
