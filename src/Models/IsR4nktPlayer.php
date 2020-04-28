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
}
