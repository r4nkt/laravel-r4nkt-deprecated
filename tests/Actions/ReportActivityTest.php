<?php

namespace R4nkt\Laravel\Tests\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use R4nkt\Laravel\Actions\ReportActivity;
use R4nkt\Laravel\Jobs\ReportActivity as ReportActivityJob;
use R4nkt\Laravel\Tests\TestCase;
use R4nkt\Laravel\Tests\TestClasses\TypicalUser;

class ReportActivityTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->user = factory(TypicalUser::class)->create();
    }

    /** @test */
    public function it_dispatches_a_job_with_minimal_input()
    {
        $customActionId = 'custom.action.id';

        ReportActivity::prep()
            ->byPlayer($this->user)
            ->customActionId($customActionId)
            ->execute();

        Queue::assertPushed(ReportActivityJob::class, function ($job) use ($customActionId) {
            return (
                ($job->activity->customPlayerId === (string) $this->user->id) &&
                ($job->activity->customActionId === $customActionId) &&
                ($job->activity->amount === 1) &&
                ($job->activity->session === null) &&
                ($job->activity->dateTimeUtc === null) &&
                ($job->activity->modifier === 'increment')
            );
        });
    }

    /** @test */
    public function it_dispatches_a_job_with_a_session_and_specified_date_time_and_modifier()
    {
        $customActionId = 'custom.action.id';
        $amount = 1234;
        $session = 'session.id';
        $dateTimeUtc = Carbon::create(2020, 5, 15, 21, 52, 38);
        $modifier = 'decrement';

        ReportActivity::prep()
            ->byPlayer($this->user)
            ->customActionId($customActionId)
            ->withAmount($amount)
            ->duringSession($session)
            ->at($dateTimeUtc)
            ->withModifier($modifier)
            ->execute();

        Queue::assertPushed(ReportActivityJob::class, function ($job) use ($customActionId, $amount, $session, $dateTimeUtc, $modifier) {
            return (
                ($job->activity->customPlayerId === (string) $this->user->id) &&
                ($job->activity->customActionId === $customActionId) &&
                ($job->activity->amount === $amount) &&
                ($job->activity->session === $session) &&
                ($job->activity->dateTimeUtc === $dateTimeUtc->toJSON()) &&
                ($job->activity->modifier === $modifier)
            );
        });
    }

    /** @test */
    public function it_dispatches_a_job_with_no_session_if_cleared()
    {
        $customActionId = 'custom.action.id';
        $session = 'session.id';

        ReportActivity::prep()
            ->byPlayer($this->user)
            ->customActionId($customActionId)
            ->duringSession($session)
            ->sansSession()
            ->execute();

        Queue::assertPushed(ReportActivityJob::class, function ($job) use ($customActionId) {
            return (
                ($job->activity->customPlayerId === (string) $this->user->id) &&
                ($job->activity->customActionId === $customActionId) &&
                ($job->activity->session === null)
            );
        });
    }

    /** @test */
    public function it_dispatches_a_job_with_no_date_time_if_cleared()
    {
        $customActionId = 'custom.action.id';
        $dateTimeUtc = Carbon::create(2020, 5, 15, 21, 52, 38);

        ReportActivity::prep()
            ->byPlayer($this->user)
            ->customActionId($customActionId)
            ->at($dateTimeUtc)
            ->rightNow()
            ->execute();

        Queue::assertPushed(ReportActivityJob::class, function ($job) use ($customActionId) {
            return (
                ($job->activity->customPlayerId === (string) $this->user->id) &&
                ($job->activity->customActionId === $customActionId) &&
                ($job->activity->dateTimeUtc === null)
            );
        });
    }
}
