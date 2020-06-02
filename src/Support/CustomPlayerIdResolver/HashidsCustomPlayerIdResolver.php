<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdResolver;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class HashidsCustomPlayerIdResolver implements CustomPlayerIdResolver
{
    public function resolve(Model $player): string
    {
        $key = $player->getKeyName();

        return Hashids::encode($player->$key);
    }
}
