<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdResolver;

use Illuminate\Database\Eloquent\Model;

interface CustomPlayerIdResolver
{
    public function resolve(Model $player): string;
}
