<?php

namespace R4nkt\Laravel\Models;

use Vinkla\Hashids\Facades\Hashids;

trait IsR4nktPlayer
{
    /**
     * [getCustomPlayerIdAttribute description]
     * @return [type] [description]
     */
    public function getCustomPlayerIdAttribute()
    {
        return Hashids::encode($this->id);
    }

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
