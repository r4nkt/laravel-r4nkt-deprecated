<?php

namespace R4nkt\Laravel\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use R4nkt\Laravel\Jobs\ReportActivity as ReportActivityJob;
use R4nkt\Laravel\Support\ActivityData;
use Telkins\LaravelPendingAction\Action;

class ReportActivity extends Action
{
    public function execute(ReportActivityPendingAction $pendingAction)
    {
        $activityData = new ActivityData([
            'customPlayerId' => $this->customPlayerId($pendingAction->player),
            'customActionId' => $pendingAction->customActionId,
            'amount' => $pendingAction->amount,
            'session' => $pendingAction->session,
            'dateTimeUtc' => $this->dateTimeUtc($pendingAction->dateTimeUtc),
            'modifier' => $pendingAction->modifier,
        ]);

        ReportActivityJob::dispatch($activityData);
    }

    protected function customPlayerId(Model $player): string
    {
        $resolverClass = config('r4nkt.custom_player_id_resolver');

        return (new $resolverClass)->resolve($player);
    }

    protected function dateTimeUtc(?Carbon $dateTimeUtc): ?string
    {
        $resolverClass = config('r4nkt.date_time_utc_resolver');

        return (new $resolverClass)->resolve($dateTimeUtc);
    }
}
