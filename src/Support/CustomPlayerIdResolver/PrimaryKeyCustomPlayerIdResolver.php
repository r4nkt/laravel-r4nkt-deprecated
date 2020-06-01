<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdResolver;

use Illuminate\Database\Eloquent\Model;

class PrimaryKeyCustomPlayerIdResolver implements CustomPlayerIdResolver
{
    public function resolve(Model $player): string
    {
        $key = $player->getKeyName();

        return $player->$key;
    }
}
