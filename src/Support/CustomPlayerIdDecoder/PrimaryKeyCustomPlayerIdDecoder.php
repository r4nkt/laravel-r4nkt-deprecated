<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdDecoder;

use Illuminate\Database\Eloquent\Model;

class PrimaryKeyCustomPlayerIdDecoder implements CustomPlayerIdDecoder
{
    public function decode(string $customPlayerId): string
    {
        return $customPlayerId;
    }
}
