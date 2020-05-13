<?php

namespace R4nkt\Laravel\Models;

trait IsR4nktPlayer
{
    /**
     * [scopeCustomPlayerId description]
     * @param  [type] $query          [description]
     * @param  [type] $customPlayerId [description]
     * @return [type]                 [description]
     */
    public function scopeCustomPlayerId($query, $customPlayerId)
    {
        $query->where('id', Hashids::decode($customPlayerId));
    }
}
