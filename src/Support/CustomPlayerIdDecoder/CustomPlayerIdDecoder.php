<?php

namespace R4nkt\Laravel\Support\CustomPlayerIdDecoder;

use Illuminate\Database\Eloquent\Model;

interface CustomPlayerIdDecoder
{
    public function decode(string $customPlayerId): string;
}
