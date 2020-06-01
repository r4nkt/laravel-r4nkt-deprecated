<?php

namespace R4nkt\Laravel;

use R4nkt\Laravel\Actions\ReportActivity;
use R4nkt\PhpSdk\R4nkt as PhpR4nkt;

class R4nkt extends PhpR4nkt
{
    public function reportActivity(string $customActionId, int $amount = 1, ?string $session = null)
    {
        ReportActivity::prep()
            ->byPlayer(auth()->user())
            ->customActionId($customActionId)
            ->withAmount($amount)
            ->duringSession($session)
            ->execute();
    }
}
