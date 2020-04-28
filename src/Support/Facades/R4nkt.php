<?php

namespace R4nkt\Laravel\Support\Facades;

use Illuminate\Support\Facades\Facade;

class R4nkt extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'r4nkt';
    }
}
