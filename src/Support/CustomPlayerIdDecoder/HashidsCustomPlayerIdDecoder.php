<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdDecoder;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class HashidsCustomPlayerIdDecoder implements CustomPlayerIdDecoder
{
    public function decode(string $customPlayerId): string
    {
        return Hashids::decode($customPlayerId)[0];
    }
}
