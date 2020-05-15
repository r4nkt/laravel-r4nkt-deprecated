<?php

namespace R4nkt\Laravel\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Telkins\LaravelPendingAction\PendingAction;

class ReportActivityPendingAction extends PendingAction
{
    /** @var \Illuminate\Database\Eloquent\Model */
    public $player;

    /** @var string */
    public $customActionId;

    /** @var int */
    public $amount = 1;

    /** @var string */
    public $session = null;

    /** @var \Illuminate\Support\Carbon */
    public $dateTimeUtc = null;

    /** @var string */
    public $modifier = 'increment';

    public function byPlayer(Model $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function customActionId(string $customActionId): self
    {
        $this->customActionId = $customActionId;

        return $this;
    }

    public function withAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function duringSession(?string $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function sansSession(): self
    {
        $this->session = null;

        return $this;
    }

    public function at(?Carbon $dateTimeUtc): self
    {
        $this->dateTimeUtc = $dateTimeUtc;

        return $this;
    }

    public function rightNow(): self
    {
        $this->dateTimeUtc = null;

        return $this;
    }

    public function withModifier(string $modifier): self
    {
        $this->modifier = $modifier;

        return $this;
    }
}