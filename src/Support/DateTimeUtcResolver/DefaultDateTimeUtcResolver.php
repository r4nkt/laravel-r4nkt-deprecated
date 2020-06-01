<?php

namespace R4nkt\Laravel\Support\DateTimeUtcResolver;

use Illuminate\Support\Carbon;

class DefaultDateTimeUtcResolver implements DateTimeUtcResolver
{
    public function resolve(?Carbon $dateTimeUtc): ?string
    {
        if (! $dateTimeUtc) {
            return null;
        }

        return $dateTimeUtc->toJSON();
    }
}
