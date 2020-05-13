<?php

namespace R4nkt\Laravel\Support\DateTimeUtcResolver;

use Illuminate\Support\Carbon;

abstract class DateTimeUtcResolver
{
    abstract public function resolve(Carbon $dateTimeUtc): ?string;
}
