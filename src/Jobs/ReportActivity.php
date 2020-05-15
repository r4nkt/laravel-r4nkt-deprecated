<?php

namespace R4nkt\Laravel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use R4nkt\Laravel\Support\ActivityData;
use R4nkt\Laravel\Support\Facades\R4nkt;

class ReportActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $activity;

    /**
     * Create a new job instance.
     *
     * @param  ActivityData  $activity
     * @return void
     */
    public function __construct(ActivityData $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        R4nkt::reportActivity(
            $this->activity->customPlayerId,
            $this->activity->customActionId,
            $this->activity->amount,
            $this->activity->session,
            $this->activity->dateTimeUtc,
            $this->activity->modifier
        );
    }
}
