<?php

namespace R4nkt\Laravel\Models;

trait IsR4nktPlayer
{
    public function getCustomPlayerIdAttribute()
    {
        $resolverClass = config('r4nkt.custom_player_id_resolver');

        return (new $resolverClass)->resolve($this);
    }

    /**
     * [scopeCustomPlayerId description]
     * @param  [type] $query          [description]
     * @param  [type] $customPlayerId [description]
     * @return [type]                 [description]
     */
    public function scopeCustomPlayerId($query, $customPlayerId)
    {
        $decoderClass = config('r4nkt.custom_player_id_decoder');

        $query->where('id', (new $decoderClass)->decode($customPlayerId));
    }
}
