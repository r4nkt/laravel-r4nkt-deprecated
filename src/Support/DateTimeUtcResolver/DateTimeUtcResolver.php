<?php

namespace R4nkt\Laravel\Support\DateTimeUtcResolver;

use Illuminate\Support\Carbon;

interface DateTimeUtcResolver
{
    public function resolve(Carbon $dateTimeUtc): ?string;
}
