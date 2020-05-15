<?php

namespace R4nkt\Laravel\Support;

use Spatie\DataTransferObject\DataTransferObject;

class ActivityData extends DataTransferObject
{
    /**
     * @var string
     */
    public $customPlayerId;

    /**
     * @var string
     */
    public $customActionId;

    /**
     * @var int|null
     */
    public $amount;

    /**
     * @var string|null
     */
    public $session;

    /**
     * @var string|null
     */
    public $dateTimeUtc;

    /**
     * @var string|null
     */
    public $modifier;
}